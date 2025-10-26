<x-filament-widgets::widget>
    <x-filament::section>
        <script>
            function init() {
                
            };
        </script>

        <img id="videoStream" x-init="
            const videoElement = document.getElementById('videoStream');
            const wsUrl = '{{ env('CAMERA_STREAMING_WS') }}';
            const socket = new WebSocket(wsUrl);
            socket.binaryType = 'blob';

            socket.onopen = () => {
                console.log('WebSocket connection established');
            };

            socket.onmessage = (event) => {
                const blob = event.data;
                const url = URL.createObjectURL(blob);
                videoElement.src = url;
                videoElement.onload = () => {
                    URL.revokeObjectURL(url);
                };
            };

            socket.onclose = () => {
                console.log('WebSocket connection closed');
            };

            socket.onerror = (err) => {
                console.error('WebSocket error:', err);
            };
        " x-data width="1280" height="720" alt="Video stream will appear here" />

        
    </x-filament::section>
</x-filament-widgets::widget>
