<?php

use App\Models\AccessEvent;
use App\Models\Car;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Route::post('/cars/detected', function (Request $request) {
    $plates = $request->plates;

    if (is_string($plates)) {
        $plates = [$plates];
    }

    foreach ($plates as $plate) {
        $car = Car::where('plate_number', $plate)->first();
        if ($car != null){
            AccessEvent::create([
                'car_id' => $car->id,
                'kind' => 'car_detected',
            ]);
        }
    }

});

Route::get('/user', function (Request $request) {
    return [
        "id" => 1,
        "name" => "Иван",
        "surname" => "Иванов",
        "patronimic" => "Иванович",
        "numberOfPhone" => "88005553535",
        "email" => "email@email.ru",
        "cars" => Car::query()->get()->toArray(),
        "addresses" => [
            [
                "id" => 0,
                "address" => "г. Саратов, ул. Московская, д.8"
            ],
        ],
    ];
});

Route::post('/user/cars', function (Request $request) {
    $data = $request->validate([
        'name' => ['string', 'required'],
        'plate_number' => ['sometimes', 'string'],
        'files.*' => ['file', 'mimes:png,jpg,jpeg']
    ]);

    $plate_number = $data['plate_number'] ?? null;

    if (empty($plate_number)) {
        $checkRequest = Http::withHeaders([
            'Accept' => 'application/json',
        ]);
        
        if (!$request->hasFile('files')) {
            return response()->json([
                'message' => 'Необходимо загрузить изображения для распознавания либо указать номер авто самостоятельно'
            ], 400);
        }

        foreach ($request->file('files') as $file) {
            $checkRequest->attach('images', file_get_contents($file), $file->getClientOriginalName());
        }
        // try {
            $response = $checkRequest->post(env('DETECT_PLATES_ROUTE'));
        // } catch (\Exception $ex) {
            // return response()->json([
            //     'error' => 'Не удалось проверить фотографии на наличие номера: внутренняя ошибка сервера'
            // ], 503);
        // }
        if (!$response->ok()) {
            return response()->json([
                'error' => 'Не удалось проверить фотографии на наличие номера: внутренняя ошибка сервера',
                'data' => $response->json()
            ], 503);
        }

        $plates = $response->json();
        if (count($plates) > 1) {
            return response()->json([
                'message' => 'Найдено несколько номеров на фото: ' . implode(',', $plates) . '. Сделайте другое фото, где будет виден только номер вашего авто либо вручную впишите свой номер'
            ], 400);
        } else if (count($plates) == 0){
            return response()->json([
                'message' => 'Номера не найдены. Попробуйте другое фото.'
            ], 404);
        }
        $plate_number = $plates[0];
    }
    $paths = [];
    foreach ($data['files'] as $file) {
        $paths[] = $file->storePublicly('cars-photos');
    }

    $car = Car::create([
        'name' => $data['name'],
        'plate_number' => $plate_number,
        'images' => $paths,
        'status' => 'accepted'
    ]);
    return $car;
    
});

Route::get('/history', function (Request $request) {
    return AccessEvent::query()->get()->toArray();
});
