
import string


allowed_numbers='0123456789'
allowed_chars='ABEKMHOPCTYX'


def assign_to_car(plate, tracked_cars):

    x1, y1, x2, y2, score, class_id = plate

    car_index = -1

    found = False
    for j in range(len(tracked_cars)):
        xc1, yc1, xc2, yc2, car_id = tracked_cars[j]

        if x1 > xc1 and y1 > yc1 and x2 < xc2 and y2 < yc2:
            car_index = j
            found = True
            break

    if found:
        return tracked_cars[car_index]

    return -1, -1, -1, -1, -1


def plate_in_good_format(text):
    l = 8

    if len(text) > l:
        text = text[:l]


    if (text[0] not in allowed_chars):
        return False

    if (text[1] not in allowed_numbers):
        return False
    
    if (text[2] not in allowed_numbers):
        return False
    
    if (text[3] not in allowed_numbers):
        return False
    
    if (text[4] not in allowed_chars):
        return False
    
    if (text[5] not in allowed_chars):
        return False
    
    if (text[6] not in allowed_numbers):
        return False
    
    if (text[7] not in allowed_numbers):
        return False
    
    return True


def format_plate_text(text):
    plate_ = ''
    mapping = {0: dict_int_to_char, 1: dict_int_to_char, 4: dict_int_to_char, 5: dict_int_to_char, 6: dict_int_to_char,
               2: dict_char_to_int, 3: dict_char_to_int}
    for j in [0, 1, 2, 3, 4, 5, 6, 7]:
        if j in mapping.keys() and text[j] in mapping[j].keys():
            plate_ += mapping[j][text[j]]
        else:
            plate_ += text[j]

    return plate_