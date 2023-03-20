<!DOCTYPE html>
<html lang="en">
<head>
<!-- meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?=$title;?></title>
<link href="<?= base_url('theme/');?>images/Lambang Wonosobo.png" rel="shortcut icon" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">

<!-- Text to Speech -->
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
<script type="text/javascript">
    
//Text to speech otomatis
    
responsiveVoice.OnVoiceReady = function() {
    console.log("speech time?");
    responsiveVoice.speak(
    "Selamat Datang di Kanal Aduan Lapor Bupati Wonosobo. Lapor Bupati Wonosobo adalah sistem pengaduan masyarakat kepada Bupati Wonosobo, yang mengintegrasikan sistem SP4N, Lapor Gubernur, Call Center, Media sosial Pimpinan Daerah, maupun sistem pengaduan pada perangkat daerah di Kabupaten Wonosobo.",
    // "Selamat Datang di Kanal Aduan Lapor Bupati Wonosobo. Lapor Bupati Wonosobo adalah sistem pengaduan masyarakat kepada Bupati Wonosobo, yang mengintegrasikan sistem SP4N, Lapor Gubernur, Call Center, Media sosial pimpinan daerah, maupun sistem pengaduan pada perangkat daerah di Kabupaten Wonosobo. Untuk membuat pengaduan, masyarakat dapat mengisi data diri dan materi pengaduan pada formulir pengaduan yang tersedia. Khusus bagi pelapor penyandang Disabilitas dapat mengirimkan aduan melalui pesan suara pada Formulir Aduan Khusus Disabilitas. langkah pertama, pelapor harus merekam aduan dengan cara klik tombol Rekam aduan. langkah kedua, pelapor harus mendownload file audio hasil rekaman. langkah ketiga, pelapor harus meng-upload file audio rekaman pada form isian yang disediakan. langkah ke empat, untuk mengirim laporan aduan, pelapor harus meng-klik tombol Laporkan. terima kasih telah menggunakan layanan Lapor Bupati Wonosobo.",
    "Indonesian Female",
    {
    pitch: 1, 
    rate: 1, 
    volume: 1
    }
    );
};
</script>

<!-- <link rel="stylesheet" href="https://www.webrtc-experiment.com/style.css"> -->
 
<!-- costum css -->
<style>     
        body{
            background: #fff;
            padding-top: 2vh;  
        }
        
        form{
            background: #a60d0d;
        }
        
        .form-container{
        color: white;
            border-radius: 10px;
            padding: 30px;
        }
</style>

</head>
  
<body style="background-image: url(<?php echo base_url().'assets/frontend_aduan/images/formaduan.jpg'?>);">
    <section class="container-fluid">
    <?= $script_captcha; ?>
        <section class="row justify-content-right">
            <section class="col-12 col-sm-6 col-md-4"  style="margin-bottom: 20px;">
                <form class="form-container" action="<?php echo base_url().'user/aduan/kirim'?>" method="post" enctype="multipart/form-data">
                    <h5 class="text-center font-weight-bold"> Formulir Aduan </h5>
                    <p><?php echo $this->session->flashdata('gagal');?></p>
                              <p><?php echo $this->session->flashdata('sukses');?></p>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="x_nama" required>
                    </div>
                    <div class="form-group">
                    <label for="">No. Hp/WA (Harus Aktif)</label>
                        <input type="number" class="form-control" name="x_hp" required>
                    </div>
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="email" class="form-control" name="x_email">
                    </div>
                    <div class="form-group">
                      <label for="">Lokasi</label>
                      <input type="text" class="form-control"  name="x_lokasi" required>
                    </div>
                    <div class="form-group">
                      <label for="">Judul Laporan</label>
                      <input type="text" class="form-control" name="x_judul_laporan" required>
                    </div>
                    <div class="form-group">
                      <label for="">Uraian Laporan Anda</label>
                      <textarea class="form-control" rows="5" name="x_isi_laporan" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Lampiran Foto</label>
                        <input type="file" class="form-control" name="x_foto" >
                    </div>
                    <div class="form-group">
                        <div align="center">
                            <?= $captcha; ?>
                        </div>
                    </div>
                    <button type="submit" style="background-color:white; margin-top: 10px;" class="btn btn-block" title="Klik untuk mengirim Aduan Anda!"><b><a style="color: red;">Laporkan !</a></b></button>
                </form>

                <!-- REKAM ADUAN MODIFIKASI -->
                <section class="experiment recordrtc">
                        <form form class="form-container" style="margin-top: 20px;">
                        <h5 class="text-center font-weight-bold"> Form Aduan Khusus Disabilitas </h5>
                            <p><?php echo $this->session->flashdata('gagal');?></p>
                                <p><?php echo $this->session->flashdata('sukses');?></p>
                        <h4 class="header" style="display: none;">
                        <div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
                            <select class="recording-media">
                                <option value="record-audio">Audio</option>
                            </select>
                            into
                            <select class="media-container-format">
                                <option>WAV</option>
                            </select>
                        </div>
                        </h4>
                        <div style="text-align: center; margin-bottom: 10px;">
                            <video controls playsinline autoplay muted=false volume=1></video>
                        </div>
                        <div style="text-align: center;">
                            <div class="btn-group">
                                <button style="background-color:white;" class="btn btn-block btn-sm" title="(1) Klik tombol ini untuk merekam suara Anda!"><b><a style="color: forestgreen;"><i class="fa fa-microphone"></i>&nbsp; Rekam Aduan</a></b></button>
                                <button type="reset" class="btn btn-success btn-sm" value ="Refresh" onclick="history.go(0)" title="Batalkan rekaman?"><b><i class="fa fa-refresh"></i>&nbsp; Batal</b></button>
                                <button class="btn btn-primary btn-sm" id="save-to-disk" title="(2) Simpan hasil rekaman untuk di Kirim."><b><i class="fa fa-download"></i>&nbsp; Download</b></button>
                            </div>
                        </div>
                        </form>
                        <form style="margin-top: -50px;" class="form-container" action="<?php echo base_url().'user/aduan/kirim_aduan_disabilitas'?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Upload Rekaman Aduan</label>
                                <input type="file" class="form-control" name="x_audio" title="(3) Upload file audio hasil rekaman disini!" required>
                            </div>
                            <div style="text-align: center; margin-bottom: 15px">
                                <button style="background-color:white;" class="btn btn-block" id="upload-to-server" title="(4) Klik untuk mengirim Aduan Anda!"><b><a style="color: red;">Laporkan !</a></b></button>
                            </div>
                            <div class="form-group">
                                <label for=""><b><i>* Petunjuk Penggunaan :</i></b></label><br>
                                <a style="font-size: 14px;">
                                    <ol align="justify">
                                        <li>Rekam Aduan Anda dengan cara klik tombol <b><i>Rekam aduan</i></b>. ( Durasi Max 2 Menit )</li>
                                        <li><b><i>Download</i></b> file Audio hasil rekaman.</li>
                                        <li><b><i>Upload file Audio</i></b> yang telah didownload pada form Upload yang disediakan.</li>
                                        <li>Kirim Aduan dengan cara Klik tombol <b><i>Laporkan!</i></b></li>
                                    </ol>
                                </a>
                            </div>
                        </form>
                </section>

            </section>
            <!-- Form Aduan Disabilitas -->
            <!-- <section class="col-12 col-sm-6 col-md-4">
                <form class="form-container" action="< ?php echo base_url().'user/aduan/kirim_aduan_disabilitas'?>" method="post" enctype="multipart/form-data">
                    <h5 class="text-center font-weight-bold"> Formulir Aduan</br>Khusus Disabilitas </h5>
                    <p>< ?php echo $this->session->flashdata('gagal');?></p>
                              <p>< ?php echo $this->session->flashdata('sukses');?></p>
                    <div class="form-group">
                        <label for="">Rekam Aduan Anda</label>
                        <input type="file" class="form-control" name="x_audio" >
                    </div>
                    <button type="submit" style="background-color:white; margin-top: 10px;" class="btn btn-block"><b><a style="color: red;">Laporkan !</a></b></button>
                </form>
            </section> -->

            <!-- COBA-COBA REKAM ASLI-->
            <!-- <section class="experiment recordrtc">
                <h2 class="header">
                    <select class="recording-media">
                        <option value="record-video">Video</option>
                        <option value="record-audio">Audio</option>
                        <option value="record-screen">Screen</option>
                    </select>
                    into
                    <select class="media-container-format">
                        <option>WebM</option>
                        <option disabled>Mp4</option>
                        <option disabled>WAV</option>
                        <option disabled>Ogg</option>
                        <option>Gif</option>
                    </select>
                    <button>Start Recording</button>
                </h2>
                <div style="text-align: center; display: none;">
                    <button id="save-to-disk">Save To Disk</button>
                    <button id="open-new-tab">Open New Tab</button>
                    <button id="upload-to-server">Upload To Server</button>
                </div>
                <br>
                <video controls playsinline autoplay muted=false volume=1></video>
            </section> -->

            <!-- REKAM ADUAN MODIFIKASI -->
            <!-- <section class="experiment recordrtc col-12 col-sm-6 col-md-4">
                    <form form class="form-container">
                    <h5 class="text-center font-weight-bold"> Form Aduan Khusus Disabilitas </h5>
                        <p>< ?php echo $this->session->flashdata('gagal');?></p>
                            <p>< ?php echo $this->session->flashdata('sukses');?></p>
                    <h4 class="header" style="display: none;">
                    <div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
                        <select class="recording-media">
                            <option value="record-audio">Audio</option>
                        </select>
                        into
                        <select class="media-container-format">
                            <option>WAV</option>
                        </select>
                    </div>
                    </h4>
                    <div style="text-align: center; margin-bottom: 10px;">
                        <video controls playsinline autoplay muted=false volume=1></video>
                    </div>
                    <div style="text-align: center;">
                        <div class="btn-group">
                            <button style="background-color:white;" class="btn btn-block btn-sm"><b><a style="color: forestgreen;" title="Klik tombol ini untuk merekam suara Anda!"><i class="fa fa-microphone"></i>&nbsp; Rekam Aduan</a></b></button>
                            <button type="reset" class="btn btn-success btn-sm" value ="Refresh" onclick="history.go(0)" title="Batalkan rekaman?"><b><i class="fa fa-refresh"></i>&nbsp; Batal</b></button>
                            <button class="btn btn-primary btn-sm" id="save-to-disk" title="Simpan hasil rekaman untuk di Kirim."><b><i class="fa fa-download"></i>&nbsp; Download</b></button>
                        </div>
                    </div>
                    </form>
                    <form style="margin-top: -50px;" class="form-container" action="< ?php echo base_url().'user/aduan/kirim_aduan_disabilitas'?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Upload Rekaman</label>
                            <input type="file" class="form-control" name="x_audio" >
                        </div>
                        <div style="text-align: center; margin-bottom: 10px">
                            <button style="background-color:white;" class="btn btn-block" id="upload-to-server" title="Klik untuk mengirim Aduan Anda!"><b><a style="color: red;">Laporkan !</a></b></button>
                        </div>
                    </form>
                <br>
            </section> -->

        </section>
    </section>
 
    <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, danyang terakhit Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://www.webrtc-experiment.com/RecordRTC.js"></script>
    <script src="https://www.webrtc-experiment.com/gif-recorder.js"></script>
    <script src="https://www.webrtc-experiment.com/getScreenId.js"></script>
    <script src="https://www.webrtc-experiment.com/DetectRTC.js"> </script>

    <!-- for Edige/FF/Chrome/Opera/etc. getUserMedia support -->
    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>

        <script type="text/javascript">
            document.onkeyup = function () {
             var e = e || window.event; // for IE to cover IEs window event-object
             if(e.which == 65) {
                    
                    // test shorcut keyboard

                    alert('Keyboard shortcut working!');

                    // End of test shortcut keboard

                return false;
                }
            }
        </script>

        <script>
            (function() {
                var params = {},
                    r = /([^&=]+)=?([^&]*)/g;

                function d(s) {
                    return decodeURIComponent(s.replace(/\+/g, ' '));
                }

                var match, search = window.location.search;
                while (match = r.exec(search.substring(1))) {
                    params[d(match[1])] = d(match[2]);

                    if(d(match[2]) === 'true' || d(match[2]) === 'false') {
                        params[d(match[1])] = d(match[2]) === 'true' ? true : false;
                    }
                }

                window.params = params;
            })();
        </script>

        <script>
            var recordingDIV = document.querySelector('.recordrtc');
            var recordingMedia = recordingDIV.querySelector('.recording-media');
            var recordingPlayer = recordingDIV.querySelector('video');
            var mediaContainerFormat = recordingDIV.querySelector('.media-container-format');

            recordingDIV.querySelector('button').onclick = function() {
                var button = this;

                if(button.innerHTML === 'Stop Recording') {
                    button.disabled = true;
                    button.disableStateWaiting = true;
                    setTimeout(function() {
                        button.disabled = false;
                        button.disableStateWaiting = false;
                    }, 2 * 1000);

                    button.innerHTML = 'Start Recording';

                    function stopStream() {
                        if(button.stream && button.stream.stop) {
                            button.stream.stop();
                            button.stream = null;
                        }
                    }

                    if(button.recordRTC) {
                        if(button.recordRTC.length) {
                            button.recordRTC[0].stopRecording(function(url) {
                                if(!button.recordRTC[1]) {
                                    button.recordingEndedCallback(url);
                                    stopStream();

                                    saveToDiskOrOpenNewTab(button.recordRTC[0]);
                                    return;
                                }

                                button.recordRTC[1].stopRecording(function(url) {
                                    button.recordingEndedCallback(url);
                                    stopStream();
                                });
                            });
                        }
                        else {
                            button.recordRTC.stopRecording(function(url) {
                                button.recordingEndedCallback(url);
                                stopStream();

                                saveToDiskOrOpenNewTab(button.recordRTC);
                            });
                        }
                    }

                    return;
                }

                button.disabled = true;

                var commonConfig = {
                    onMediaCaptured: function(stream) {
                        button.stream = stream;
                        if(button.mediaCapturedCallback) {
                            button.mediaCapturedCallback();
                        }

                        button.innerHTML = 'Stop Recording';
                        button.disabled = false;
                    },
                    onMediaStopped: function() {
                        button.innerHTML = 'Start Recording';

                        if(!button.disableStateWaiting) {
                            button.disabled = false;
                        }
                    },
                    onMediaCapturingFailed: function(error) {
                        if(error.name === 'PermissionDeniedError' && !!navigator.mozGetUserMedia) {
                            InstallTrigger.install({
                                'Foo': {
                                    // https://addons.mozilla.org/firefox/downloads/latest/655146/addon-655146-latest.xpi?src=dp-btn-primary
                                    URL: 'https://addons.mozilla.org/en-US/firefox/addon/enable-screen-capturing/',
                                    toString: function () {
                                        return this.URL;
                                    }
                                }
                            });
                        }

                        commonConfig.onMediaStopped();
                    }
                };

                if(recordingMedia.value === 'record-video') {
                    captureVideo(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: mediaContainerFormat.value === 'Gif' ? 'gif' : 'video',
                            disableLogs: params.disableLogs || false,
                            canvas: {
                                width: params.canvas_width || 320,
                                height: params.canvas_height || 240
                            },
                            frameInterval: typeof params.frameInterval !== 'undefined' ? parseInt(params.frameInterval) : 20 // minimum time between pushing frames to Whammy (in milliseconds)
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.src = null;
                            recordingPlayer.srcObject = null;

                            if(mediaContainerFormat.value === 'Gif') {
                                recordingPlayer.pause();
                                recordingPlayer.poster = url;

                                recordingPlayer.onended = function() {
                                    recordingPlayer.pause();
                                    recordingPlayer.poster = URL.createObjectURL(button.recordRTC.blob);
                                };
                                return;
                            }

                            recordingPlayer.src = url;

                            recordingPlayer.onended = function() {
                                recordingPlayer.pause();
                                recordingPlayer.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-audio') {
                    captureAudio(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: 'audio',
                            bufferSize: typeof params.bufferSize == 'undefined' ? 0 : parseInt(params.bufferSize),
                            sampleRate: typeof params.sampleRate == 'undefined' ? 44100 : parseInt(params.sampleRate),
                            leftChannel: params.leftChannel || false,
                            disableLogs: params.disableLogs || false,
                            recorderType: DetectRTC.browser.name === 'Edge' ? StereoAudioRecorder : null
                        });

                        button.recordingEndedCallback = function(url) {
                            var audio = new Audio();
                            audio.src = url;
                            audio.controls = true;
                            recordingPlayer.parentNode.appendChild(document.createElement('hr'));
                            recordingPlayer.parentNode.appendChild(audio);

                            if(audio.paused) audio.play();

                            audio.onended = function() {
                                audio.pause();
                                audio.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-audio-plus-video') {
                    captureAudioPlusVideo(commonConfig);

                    button.mediaCapturedCallback = function() {

                        if(DetectRTC.browser.name !== 'Firefox') { // opera or chrome etc.
                            button.recordRTC = [];

                            if(!params.bufferSize) {
                                // it fixes audio issues whilst recording 720p
                                params.bufferSize = 16384;
                            }

                            var audioRecorder = RecordRTC(button.stream, {
                                type: 'audio',
                                bufferSize: typeof params.bufferSize == 'undefined' ? 0 : parseInt(params.bufferSize),
                                sampleRate: typeof params.sampleRate == 'undefined' ? 44100 : parseInt(params.sampleRate),
                                leftChannel: params.leftChannel || false,
                                disableLogs: params.disableLogs || false,
                                recorderType: DetectRTC.browser.name === 'Edge' ? StereoAudioRecorder : null
                            });

                            var videoRecorder = RecordRTC(button.stream, {
                                type: 'video',
                                disableLogs: params.disableLogs || false,
                                canvas: {
                                    width: params.canvas_width || 320,
                                    height: params.canvas_height || 240
                                },
                                frameInterval: typeof params.frameInterval !== 'undefined' ? parseInt(params.frameInterval) : 20 // minimum time between pushing frames to Whammy (in milliseconds)
                            });

                            // to sync audio/video playbacks in browser!
                            videoRecorder.initRecorder(function() {
                                audioRecorder.initRecorder(function() {
                                    audioRecorder.startRecording();
                                    videoRecorder.startRecording();
                                });
                            });

                            button.recordRTC.push(audioRecorder, videoRecorder);

                            button.recordingEndedCallback = function() {
                                var audio = new Audio();
                                audio.src = audioRecorder.toURL();
                                audio.controls = true;
                                audio.autoplay = true;

                                audio.onloadedmetadata = function() {
                                    recordingPlayer.src = videoRecorder.toURL();
                                };

                                recordingPlayer.parentNode.appendChild(document.createElement('hr'));
                                recordingPlayer.parentNode.appendChild(audio);

                                if(audio.paused) audio.play();
                            };
                            return;
                        }

                        button.recordRTC = RecordRTC(button.stream, {
                            type: 'video',
                            disableLogs: params.disableLogs || false,
                            // we can't pass bitrates or framerates here
                            // Firefox MediaRecorder API lakes these features
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.srcObject = null;
                            recordingPlayer.muted = false;
                            recordingPlayer.src = url;

                            recordingPlayer.onended = function() {
                                recordingPlayer.pause();
                                recordingPlayer.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-screen') {
                    captureScreen(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: mediaContainerFormat.value === 'Gif' ? 'gif' : 'video',
                            disableLogs: params.disableLogs || false,
                            canvas: {
                                width: params.canvas_width || 320,
                                height: params.canvas_height || 240
                            }
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.src = null;
                            recordingPlayer.srcObject = null;

                            if(mediaContainerFormat.value === 'Gif') {
                                recordingPlayer.pause();
                                recordingPlayer.poster = url;
                                recordingPlayer.onended = function() {
                                    recordingPlayer.pause();
                                    recordingPlayer.poster = URL.createObjectURL(button.recordRTC.blob);
                                };
                                return;
                            }

                            recordingPlayer.src = url;
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-audio-plus-screen') {
                    captureAudioPlusScreen(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: 'video',
                            disableLogs: params.disableLogs || false,
                            // we can't pass bitrates or framerates here
                            // Firefox MediaRecorder API lakes these features
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.srcObject = null;
                            recordingPlayer.muted = false;
                            recordingPlayer.src = url;

                            recordingPlayer.onended = function() {
                                recordingPlayer.pause();
                                recordingPlayer.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }
            };

            function captureVideo(config) {
                captureUserMedia({video: true}, function(videoStream) {
                    recordingPlayer.srcObject = videoStream;

                    config.onMediaCaptured(videoStream);

                    videoStream.onended = function() {
                        config.onMediaStopped();
                    };
                }, function(error) {
                    config.onMediaCapturingFailed(error);
                });
            }

            function captureAudio(config) {
                captureUserMedia({audio: true}, function(audioStream) {
                    recordingPlayer.srcObject = audioStream;

                    config.onMediaCaptured(audioStream);

                    audioStream.onended = function() {
                        config.onMediaStopped();
                    };
                }, function(error) {
                    config.onMediaCapturingFailed(error);
                });
            }

            function captureAudioPlusVideo(config) {
                captureUserMedia({video: true, audio: true}, function(audioVideoStream) {
                    recordingPlayer.srcObject = audioVideoStream;

                    config.onMediaCaptured(audioVideoStream);

                    audioVideoStream.onended = function() {
                        config.onMediaStopped();
                    };
                }, function(error) {
                    config.onMediaCapturingFailed(error);
                });
            }

            function captureScreen(config) {
                getScreenId(function(error, sourceId, screenConstraints) {
                    if (error === 'not-installed') {
                        document.write('<h1><a target="_blank" href="https://chrome.google.com/webstore/detail/screen-capturing/ajhifddimkapgcifgcodmmfdlknahffk">Please install this chrome extension then reload the page.</a></h1>');
                    }

                    if (error === 'permission-denied') {
                        alert('Screen capturing permission is denied.');
                    }

                    if (error === 'installed-disabled') {
                        alert('Please enable chrome screen capturing extension.');
                    }

                    if(error) {
                        config.onMediaCapturingFailed(error);
                        return;
                    }

                    captureUserMedia(screenConstraints, function(screenStream) {
                        recordingPlayer.srcObject = screenStream;

                        config.onMediaCaptured(screenStream);

                        screenStream.onended = function() {
                            config.onMediaStopped();
                        };
                    }, function(error) {
                        config.onMediaCapturingFailed(error);
                    });
                });
            }

            function captureAudioPlusScreen(config) {
                getScreenId(function(error, sourceId, screenConstraints) {
                    if (error === 'not-installed') {
                        document.write('<h1><a target="_blank" href="https://chrome.google.com/webstore/detail/screen-capturing/ajhifddimkapgcifgcodmmfdlknahffk">Please install this chrome extension then reload the page.</a></h1>');
                    }

                    if (error === 'permission-denied') {
                        alert('Screen capturing permission is denied.');
                    }

                    if (error === 'installed-disabled') {
                        alert('Please enable chrome screen capturing extension.');
                    }

                    if(error) {
                        config.onMediaCapturingFailed(error);
                        return;
                    }

                    screenConstraints.audio = true;

                    captureUserMedia(screenConstraints, function(screenStream) {
                        recordingPlayer.srcObject = screenStream;

                        config.onMediaCaptured(screenStream);

                        screenStream.onended = function() {
                            config.onMediaStopped();
                        };
                    }, function(error) {
                        config.onMediaCapturingFailed(error);
                    });
                });
            }

            function captureUserMedia(mediaConstraints, successCallback, errorCallback) {
                navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
            }

            function setMediaContainerFormat(arrayOfOptionsSupported) {
                var options = Array.prototype.slice.call(
                    mediaContainerFormat.querySelectorAll('option')
                );

                var selectedItem;
                options.forEach(function(option) {
                    option.disabled = true;

                    if(arrayOfOptionsSupported.indexOf(option.value) !== -1) {
                        option.disabled = false;

                        if(!selectedItem) {
                            option.selected = true;
                            selectedItem = option;
                        }
                    }
                });
            }

            recordingMedia.onchange = function() {
                if(this.value === 'record-audio') {
                    setMediaContainerFormat(['WAV', 'Ogg']);
                    return;
                }
                setMediaContainerFormat(['WebM', /*'Mp4',*/ 'Gif']);
            };

            if(DetectRTC.browser.name === 'Edge') {
                // webp isn't supported in Microsoft Edge
                // neither MediaRecorder API
                // so lets disable both video/screen recording options

                console.warn('Neither MediaRecorder API nor webp is supported in Microsoft Edge. You cam merely record audio.');

                recordingMedia.innerHTML = '<option value="record-audio">Audio</option>';
                setMediaContainerFormat(['WAV']);
            }

            if(DetectRTC.browser.name === 'Firefox') {
                // Firefox implemented both MediaRecorder API as well as WebAudio API
                // Their MediaRecorder implementation supports both audio/video recording in single container format
                // Remember, we can't currently pass bit-rates or frame-rates values over MediaRecorder API (their implementation lakes these features)

                recordingMedia.innerHTML = '<option value="record-audio-plus-video">Audio+Video</option>'
                                            + '<option value="record-audio-plus-screen">Audio+Screen</option>'
                                            + recordingMedia.innerHTML;
            }

            // disabling this option because currently this demo
            // doesn't supports publishing two blobs.
            // todo: add support of uploading both WAV/WebM to server.
            if(false && DetectRTC.browser.name === 'Chrome') {
                recordingMedia.innerHTML = '<option value="record-audio-plus-video">Audio+Video</option>'
                                            + recordingMedia.innerHTML;
                console.info('This RecordRTC demo merely tries to playback recorded audio/video sync inside the browser. It still generates two separate files (WAV/WebM).');
            }

            var MY_DOMAIN = 'localhost/laporbupati/'; //var MY_DOMAIN = 'webrtc-experiment.com';

            function isMyOwnDomain() {
                // replace "webrtc-experiment.com" with your own domain name
                return document.domain.indexOf(MY_DOMAIN) !== -1;
            }

            function saveToDiskOrOpenNewTab(recordRTC) {
                recordingDIV.querySelector('#save-to-disk').parentNode.style.display = 'block';
                recordingDIV.querySelector('#save-to-disk').onclick = function() {
                    if(!recordRTC) return alert('No recording found.');

                    recordRTC.save();
                };

                recordingDIV.querySelector('#open-new-tab').onclick = function() {
                    if(!recordRTC) return alert('No recording found.');

                    window.open(recordRTC.toURL());
                };

                if(isMyOwnDomain()) {
                    recordingDIV.querySelector('#upload-to-server').disabled = true;
                    recordingDIV.querySelector('#upload-to-server').style.display = 'none';
                }
                else {
                    recordingDIV.querySelector('#upload-to-server').disabled = false;
                }
                
                recordingDIV.querySelector('#upload-to-server').onclick = function() {
                    if(isMyOwnDomain()) {
                        alert('PHP Upload is not available on this domain.');
                        return;
                    }

                    if(!recordRTC) return alert('No recording found.');
                    this.disabled = true;

                    var button = this;
                    uploadToServer(recordRTC, function(progress, fileURL) {
                        if(progress === 'ended') {
                            button.disabled = false;
                            button.innerHTML = 'Click to download from server';
                            button.onclick = function() {
                                window.open(fileURL);
                            };
                            return;
                        }
                        button.innerHTML = progress;
                    });
                };
            }

            var listOfFilesUploaded = [];

            function uploadToServer(recordRTC, callback) {
                var blob = recordRTC instanceof Blob ? recordRTC : recordRTC.blob;
                var fileType = blob.type.split('/')[0] || 'audio';
                var fileName = (Math.random() * 1000).toString().replace('.', '');

                if (fileType === 'audio') {
                    fileName += '.' + (!!navigator.mozGetUserMedia ? 'ogg' : 'wav');
                } else {
                    fileName += '.webm';
                }

                // create FormData
                var formData = new FormData();
                formData.append(fileType + '-filename', fileName);
                formData.append(fileType + '-blob', blob);

                callback('Uploading ' + fileType + ' recording to server.');

                // var upload_url = 'https://your-domain.com/files-uploader/';
                var upload_url = 'save.php'; //var upload_url = 'save.php';

                // var upload_directory = upload_url;
                var upload_directory = 'assets/audio/'; //var upload_directory = 'uploads/';

                makeXMLHttpRequest(upload_url, formData, function(progress) {
                    if (progress !== 'upload-ended') {
                        callback(progress);
                        return;
                    }

                    callback('ended', upload_directory + fileName);

                    // to make sure we can delete as soon as visitor leaves
                    listOfFilesUploaded.push(upload_directory + fileName);
                });
            }

            function makeXMLHttpRequest(url, data, callback) {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        callback('upload-ended');
                    }
                };

                request.upload.onloadstart = function() {
                    callback('Upload started...');
                };

                request.upload.onprogress = function(event) {
                    callback('Upload Progress ' + Math.round(event.loaded / event.total * 100) + "%");
                };

                request.upload.onload = function() {
                    callback('progress-about-to-end');
                };

                request.upload.onload = function() {
                    callback('progress-ended');
                };

                request.upload.onerror = function(error) {
                    callback('Failed to upload to server');
                    console.error('XMLHttpRequest failed', error);
                };

                request.upload.onabort = function(error) {
                    callback('Upload aborted.');
                    console.error('XMLHttpRequest aborted', error);
                };

                request.open('POST', url);
                request.send(data);
            }

            window.onbeforeunload = function() {
                recordingDIV.querySelector('button').disabled = false;
                recordingMedia.disabled = false;
                mediaContainerFormat.disabled = false;

                if(!listOfFilesUploaded.length) return;

                var delete_url = 'https://webrtcweb.com/f/delete.php';
                // var delete_url = 'RecordRTC-to-PHP/delete.php';

                listOfFilesUploaded.forEach(function(fileURL) {
                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function() {
                        if (request.readyState == 4 && request.status == 200) {
                            if(this.responseText === ' problem deleting files.') {
                                alert('Failed to delete ' + fileURL + ' from the server.');
                                return;
                            }

                            listOfFilesUploaded = [];
                            alert('You can leave now. Your files are removed from the server.');
                        }
                    };
                    request.open('POST', delete_url);

                    var formData = new FormData();
                    formData.append('delete-file', fileURL.split('/').pop());
                    request.send(formData);
                });

                return 'Please wait few seconds before your recordings are deleted from the server.';
            };
        </script>

        <script>
        window.useThisGithubPath = 'muaz-khan/RecordRTC';
    </script>
    <script src="https://www.webrtc-experiment.com/commits.js" async></script>

</body>
</html>