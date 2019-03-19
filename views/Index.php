<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Camera Page</title>
</head>

<body>


<input type="file" accept="image/*;capture=camera">
<input type="file" accept="image/*;capture=camcorder">
<input type="file" accept="audio/*;capture=microphone">

<device type="media" onchange="ontimeupdate(this.data)"> </device>
<video autoplay></video>

<script>
    function update(stream) {
        document.querySelector('video').src = stream.url;
    }

    function hasGetUserMedia() {
        return !!
            (navigator.mediaDevices.getUserMedia);
    }

    if (hasGetUserMedia()) {
        // Good to go
    } else {
        alert("getUserMedia() is not supported by your browser");
    }
</script>

<!--Getting access to input device-->

<video autoplay></video>

<script>
    const constraints = {
        video: true
    };
    const video = document.querySelector('video');


    navigator.mediaDevices.getUserMedia(constraints).then((stream) => {video.srcObject = stream});

    // HD Device
    const hdConstraints = {
        video: {width: {min: 1280},
                height: {exact: 480}}
    };

    navigator.mediaDevices.getUserMedia(hdConstraints).then((stream) => {video.srcObject = stream});

    // VGA Device
    const vgaConstraints = {
        video: {width: {exact: 640},
                height: {exact: 480}}
    };

    navigator.mediaDevices.getUserMedia(vgaConstraints).then((stream) => {video.srcObject = stream});


    const videoElement = document.querySelector('video');
    const audioSelect = document.querySelector('select#audioSource');
    const videoSelect = document.querySelector('select#videoSource');

    navigator.mediaDevices.enumerateDevices()
        .then(gotDevices).then(getStream).catch(handleError);

    audioSelect.onchange = getStream;
    videoSelect.onchange = getStream;

    function gotDevices(deviceInfos) {
        for (let i = 0; i !== deviceInfos.length; ++i) {
            const deviceInfo = deviceInfos[i];
            const option = document.createElement('option');
            option.value = deviceInfo.deviceId;
            if (deviceInfo.kind === 'audioinput') {
                option.text = deviceInfo.label || 'microphone ' + (audioSelect.length + 1);
                audioSelect.appendChild(option);
            } else if (deviceInfo.kind === 'videoinput') {
                option.text = deviceInfo.label || 'camera ' + (videoSelect.length + 1);
            } else {
                console.log('Found another kind of device: ', deviceInfo);
            }
        }
    }

    function getStream() {

        if (window.stream) {

            window.stream.getTracks().forEach(function (track) {
                track.stop();
            });

            const constraints = {
                audio: { deviceId: { exact: audioSelect.value } },
                video: { deviceId: { exact: videoSelect.value } };
            }

            navigator.mediaDevices.getUserMedia(constraints)
                .then(gotStream).catch(handleError);
        }

        function gotStream(stream) {
            window.stream = stream;
            // make stream avaliable to console
            videoElement.srcObject = stream;
        }

        function handleError(error) {
            console.error('Error: ', error);
        }


    }


</script>

</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: mrybak
 * Date: 17.03.2019
 * Time: 16:34
 */

echo "Index page !!!"




?>