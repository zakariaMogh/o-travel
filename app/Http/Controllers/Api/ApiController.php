<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    private $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondInvalidRequest($message = 'Invalid Request')
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    public function respondCreated($message = 'Created Successfully',$data = [])
    {
        return $this->setStatusCode(201)->respondWithSuccessWithoutArray($message,$data);
    }

    public function respondUpdated($message = 'Updated Successfully',$data = [])
    {
        return $this->setStatusCode(201)->respondWithSuccessWithoutArray($message,$data);
    }

    public function respondInternalError($message = 'Internal Server Error')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    public function respondNoContent()
    {
        return response()->noContent();
    }

    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithSuccess($message,array $data = [])
    {
        return $this->respond([
            'success' => [
                'message' => $message
            ],
            count($data)  === 0 ? null : 'data' => $data
        ]);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message
            ]
        ]);

    }

    public function respondWithSuccessWithoutArray($message,$data)
    {
        return $this->respond([
            'success' => [
                'message' => $message
            ],
            'data' => $data
        ]);
    }
}
