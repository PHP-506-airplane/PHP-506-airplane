<!DOCTYPE html>
<html lang="ko" style="box-sizing: border-box;">
<head style="box-sizing: border-box;">
    <meta charset="UTF-8" style="box-sizing: border-box;">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" style="box-sizing: border-box;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" style="box-sizing: border-box;">
    <title style="box-sizing: border-box;">Document</title>
</head>
<body style="box-sizing: border-box;height: 100vh;margin: 0;);color: #363c44;font-size: 14px;font-family: 'Roboto', sans-serif;">
    <div class="boarding-pass" style="box-sizing: border-box;width: 350px;background: #fff;border-radius: 12px;box-shadow: 0 5px 30px rgba(0, 0, 0, .2);overflow: hidden;text-transform: uppercase;margin: 30px auto;display: inline-block;border: 1px solid #ccc;">
        <header style="box-sizing: border-box;background: linear-gradient(to bottom, #36475f, #2c394f);padding: 12px 20px;height: 53px;">
            <div class="flight" style="box-sizing: border-box;float: left;color: #fff;">
                <strong style="box-sizing: border-box;font-size: 18px;display: block;">{{$reserveData->line_name}}</strong>
            </div>
        </header>
        <section class="cities" style="box-sizing: border-box;position: relative;display: flex;justify-content: space-between;">
            <div class="city" style="box-sizing: border-box;padding: 20px 18px;">
                <small style="box-sizing: border-box;display: block;font-size: 11px;color: #A2A9B3;margin-bottom: 0px;margin-left: 3px;">{{str_replace('공항', '' , $reserveData->dep_port_name)}}</small>

                <strong style="box-sizing: border-box;font-size: 40px;display: block;font-weight: 300;line-height: 1;">{{strtoupper($reserveData->dep_port_eng)}}</strong>
            </div>
            <div class="city cityRight" style="margin-left: 100px;box-sizing: border-box;padding: 20px 18px;">
                <small style="box-sizing: border-box;display: block;font-size: 11px;color: #A2A9B3;margin-bottom: 0px;margin-left: 3px;">{{str_replace('공항', '' , $reserveData->arr_port_name)}}</small>

                <strong style="box-sizing: border-box;font-size: 40px;display: block;font-weight: 300;line-height: 1;">{{strtoupper($reserveData->arr_port_eng)}}</strong>
            </div>
            <svg class="airplane" style="box-sizing: border-box;position: absolute;width: 30px;height: 25px;top: 57%;left: 30%;opacity: 0;transform: translate(-50%, -50%);animation: move 4s infinite;">
                <use xlink:href="#airplane" style="box-sizing: border-box;"></use>
            </svg>
        </section>
        <section class="infos" style="box-sizing: border-box;display: flex;border-top: 1px solid #99D298;">
            <div class="places" style="box-sizing: border-box;width: 50%;padding: 10px 0;background: #E2EFE2;border-right: 1px solid #99D298;">
                <div class="box" style="box-sizing: border-box;padding: 10px 20px 10px;width: 47%;float: left;">
                    <small style="box-sizing: border-box;display: block;font-size: 10px;color: #97A1AD;margin-bottom: 2px;">Linecode</small>
                    <strong style="box-sizing: border-box;font-size: 15px;display: block;color: #239422;"><em style="box-sizing: border-box;">{{$reserveData->line_code}}</em></strong>
                </div>
                <div class="box" style="box-sizing: border-box;padding: 10px 20px 10px;width: 47%;float: left;">
                    <small style="box-sizing: border-box;display: block;font-size: 10px;color: #97A1AD;margin-bottom: 2px;">airplane</small>
                    <strong style="box-sizing: border-box;font-size: 15px;display: block;color: #239422;"><em style="box-sizing: border-box;">{{$reserveData->plane_name}}</em></strong>
                </div>
                <div class="box" style="box-sizing: border-box;padding: 10px 20px 10px;width: 47%;float: left;">
                    <small style="box-sizing: border-box;display: block;font-size: 10px;color: #97A1AD;margin-bottom: 2px;">Seat</small>
                    <strong style="box-sizing: border-box;font-size: 15px;display: block;color: #239422;">{{$reserveData->seat_no}}</strong>
                </div>
                <div class="box" style="box-sizing: border-box;padding: 10px 20px 10px;width: 47%;float: left;">
                    <small style="box-sizing: border-box;display: block;font-size: 10px;color: #97A1AD;margin-bottom: 2px;">Flight</small>
                    <strong style="box-sizing: border-box;font-size: 15px;display: block;color: #239422;">{{$reserveData->flight_num}}</strong>
                </div>
            </div>
            <div class="times" style="box-sizing: border-box;width: 50%;padding: 10px 0;">
                <div class="box" style="box-sizing: border-box;padding: 10px 20px 10px;width: 47%;float: left;">
                    <small style="box-sizing: border-box;display: block;font-size: 10px;color: #A2A9B3;margin-bottom: 2px;">Date</small>
                    <strong style="box-sizing: border-box;font-size: 15px;display: block;transform: scale(0.9);transform-origin: left bottom;">{{substr($reserveData->fly_date, 5)}}</strong>
                </div>
                <div class="box" style="box-sizing: border-box;padding: 10px 20px 10px;width: 47%;float: left;">
                    <small style="box-sizing: border-box;display: block;font-size: 10px;color: #A2A9B3;margin-bottom: 2px;">Departure</small>
                    <strong style="box-sizing: border-box;font-size: 15px;display: block;transform: scale(0.9);transform-origin: left bottom;">{{substr($reserveData->dep_time, 0, 2) . ':' . substr($reserveData->dep_time, 2)}}</strong>
                </div>
                <div class="box" style="box-sizing: border-box;padding: 10px 20px 10px;width: 47%;float: left;">
                    <small style="box-sizing: border-box;display: block;font-size: 10px;color: #A2A9B3;margin-bottom: 2px;">Duration</small>
                    <strong style="box-sizing: border-box;font-size: 15px;display: block;transform: scale(0.9);transform-origin: left bottom;">{{TimeCalculation($reserveData->dep_time, $reserveData->arr_time)}}</strong>
                </div>
                <div class="box" style="box-sizing: border-box;padding: 10px 20px 10px;width: 47%;float: left;">
                    <small style="box-sizing: border-box;display: block;font-size: 10px;color: #A2A9B3;margin-bottom: 2px;">Arrival</small>
                    <strong style="box-sizing: border-box;font-size: 15px;display: block;transform: scale(0.9);transform-origin: left bottom;">{{substr($reserveData->arr_time, 0, 2) . ':' . substr($reserveData->arr_time, 2)}}</strong>
                </div>
            </div>
        </section>
        <section class="strap" style="box-sizing: border-box;clear: both;position: relative;border-top: 1px solid #99D298;">
            <div class="box" style="box-sizing: border-box;padding: 23px 0 20px 20px;">
                <div class="passenger" style="box-sizing: border-box;margin-bottom: 15px;">
                    <small style="box-sizing: border-box;display: block;font-size: 10px;color: #A2A9B3;margin-bottom: 2px;">passenger</small>
                    <strong style="box-sizing: border-box;font-size: 13px;display: block;">{{$reserveData['u_name']}}</strong>
                </div>
            </div>
        </section>
    </div>
    <img src="{{$message->embed(public_path() . '/img/qr.png')}}" alt="QR code" class="imgQr" style="box-sizing: border-box;width: 80px;height: 80px;display: inline-block;position: absolute;bottom: 45px;left: 250px;">

    <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none" style="box-sizing: border-box;">
        <symbol id="airplane" viewbox="243.5 245.183 25 21.633" style="box-sizing: border-box;">
            <g style="box-sizing: border-box;">
                <path fill="#30af2f" d="M251.966,266.816h1.242l6.11-8.784l5.711,0.2c2.995-0.102,3.472-2.027,3.472-2.308
                                        c0-0.281-0.63-2.184-3.472-2.157l-5.711,0.2l-6.11-8.785h-1.242l1.67,8.983l-6.535,0.229l-2.281-3.28h-0.561v3.566
                                        c-0.437,0.257-0.738,0.724-0.757,1.266c-0.02,0.583,0.288,1.101,0.757,1.376v3.563h0.561l2.281-3.279l6.535,0.229L251.966,266.816z
                                        " style="box-sizing: border-box;"></path>
            </g>
        </symbol>
    </svg>
</body>
</html>
