<?php

namespace App\Controllers;

use App\Domain\Models\VendorsModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class VendorsController extends BaseController
{
    public function __construct(private VendorsModel $vendors_model) {}
    /**
     * Handles GET /vendors
     * Returns a paginated list of vendors with optional filters.
     *
     * @param Request $request The HTTP Request.
     * @param Response $response The HTTP Response.
     * @return Response JSON response with vendors data.
     */
    public function handleGetVendors(Request $request, Response $response): Response
    {
        // TODO: Get a list of zero or more vendor resources that match the request's filtering criteria

        //* Get filters from query string.
        $filters = $request->getQueryParams();
        //* Fetch vendors from database.
        $vendors = $this->vendors_model->getVendors($filters);
        //* Return JSON response.
        return $this->renderJson($response, $vendors);


    }

    //* ROUTE: GET /vendors/{vendor_id}
    public function handleGetVendorById(
        Request $request,
        Response $response,
        array $uri_args
    ): Response {
        // TODO: In the VendorModel
        // echo "skib";
        //dd($uri_args);
        //? 1) Get the received id from the uri.
        $vendor_id = $uri_args["vendor_id"];
        //* Checks what needs to be validated to be implemented
        //* 1) If it is a set? and not a null
        //* 2) Validate its expected data type: int
        //* 2.a) Using PHP built-in: is_*| Regex:
        //* 3) Cast the received ID. (Happy Path)

        //? 2) Fetch the info about the specified vendor from the DB by ID.
        $vendor = $this->vendors_model->findVendorById($vendor_id);

        //? 3) Prepare and return a JSON response.

        //! 5 What if the ID was valid but there was no matching record?
        //* 404 not found

        if ($vendor === false) {
            //? Option 1: throw and HTTP specialized exception
            //! throw new HttpNotFoundException($request, "There was no record that supplied vendor id ..");
            //? Option 2 : Create a well structured specialized exception.
            $payload = [
                "status" => "code",
                "code" => 404,
                "message" => "There was no record matching the supplied vendor id..",
            ];
            return $this->renderJson(
                $response,
                $payload,
                404
            );
        }
        //? HAPPY PATH:
        return $this->renderJson($response, $vendor)
        // End of callback
        //* we already have this in the base controller lol
        // $payload = json_encode($vendor);
        // $response->getBody()->write($payload);

        // return $response-> withHeader(
        //     HEADERS_CONTENT_TYPE,
        //     APP_MEDIA_TYPE_JSON
        //     );


    }
}
