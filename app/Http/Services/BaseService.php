<?php


namespace App\Http\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class BaseService
 *
 * @package App\Services
 */
class BaseService
{

    /** @const string */
    const RESPONSE_SUCCESS = 'success';

    /** @const string */
    const RESPONSE_ERROR = 'error';

    /** @var null */
    protected $data = null;

    /** @var null */
    protected $errorMessage = null;

    /** @var string */
    protected $responseType;

    /**
     * Build the response.
     *
     * @param int $statusCode
     *
     * @return JsonResponse
     */
    private function returnResponse($statusCode = Response::HTTP_OK)
    {
        $response = [
            'responseType' => $this->responseType,
            'data' => $this->data,
            'errorMessage' => $this->errorMessage
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * Return not found error.
     *
     * @param null $errorMessage
     *
     * @return JsonResponse
     */
    protected function returnNotFound($errorMessage = null)
    {
        $this->responseType = self::RESPONSE_ERROR;
        $this->errorMessage = $errorMessage ? $errorMessage : 'errors.notFound';

        return $this->returnResponse(Response::HTTP_OK);
    }

    /**
     * Return bad request error.
     *
     * @param null $errorMessage
     *
     * @return JsonResponse
     */
    protected function returnBadRequest($errorMessage = null)
    {
        $this->responseType = self::RESPONSE_ERROR;
        $this->errorMessage = $errorMessage ? $errorMessage : 'errors.badRequest';

        return $this->returnResponse(Response::HTTP_OK);
    }

    /**
     * Return data error.
     *
     * @param $errorMessage
     *
     * @return JsonResponse
     */
    protected function returnNotAcceptable($errorMessage)
    {
        $this->responseType = self::RESPONSE_ERROR;
        $this->errorMessage = $errorMessage;

        return $this->returnResponse(Response::HTTP_OK);
    }


    /**
     * Return unknown error.
     *
     * @param null $errorMessage
     *
     * @return JsonResponse
     */
    protected function returnError($errorMessage = null)
    {
        $this->responseType = self::RESPONSE_ERROR;
        $this->errorMessage = $errorMessage ? $errorMessage : 'errors.error';

        return $this->returnResponse(Response::HTTP_OK);
    }

    /**
     * Return success.
     *
     * @param null $data
     *
     * @return JsonResponse
     */
    protected function returnSuccess($data = null)
    {
        $this->responseType = self::RESPONSE_SUCCESS;
        $this->data = [
            'result' => $data,
        ];

        return $this->returnResponse();
    }

}
