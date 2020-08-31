<?php

namespace App\Http\Services;

use App\ProxyTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


/**
 * Class UserService
 * @package App\Services
 */
class ProxyService extends BaseService
{


    public function _validateAdd(Request $request)
    {
        $rules = [
            'ip_address' => 'required|ip',
            'port' => 'required|integer',
            'username' => 'string|nullable|min:4',
            'password' => 'string|nullable|min:4',
            'url' => 'required|url',
        ];

        return Validator::make($request->all(), $rules);
    }


    public function test(Request $request)
    {

        try {

            $time_start = microtime(true);

            $validator = $this->_validateAdd($request);

            if (!$validator->passes()) {
                return $this->returnBadRequest($validator->messages());
            }

            $data = $request->only([
                'ip_address',
                'port',
                'username',
                'password',
                'url',
                'status'
            ]);

            $url = $data['url'];
            $proxy = $data['ip_address'] . ':' . $data['port'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);

            if ($data['username'] && $data['password']) {
                $proxyauth = $data['ip_address'] . ':' . $data['password'];;
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
            }

            $curl_scraped_page = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            $data['status'] = $http_status;

            $newProxyTest = new ProxyTest($data);
            $recordId = $newProxyTest->save();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start) * 1000); ;

            if ($error) {
                return $this->returnError(['status' => $http_status, 'error' => $error, 'time' => $execution_time]);
            }

            return $this->returnSuccess(['status' => $http_status, 'time' => $execution_time, 'recordId' => $recordId]);

        } catch (\Exception $e) {
            return $this->returnBadRequest(['generalError' => $e->getMessage()]);
        }

    }

}
