<?php

namespace App\Controllers;

use App\Domain\Models\VendorsModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class VendorsController extends BaseController
{
    public function __construct(private VendorsModel $vendors_model) {}
    // this class will be used to create the callback
    public function handleGetVendors(Request $request, Response $response): Response
    {

        // Test the request and response cycle, because b4 writing the entire logic, we must test
        // the callback function
        // echo "Please work";
        // exit;

        // todo: add support for filtering /vendors collection by name
        //* STEP 1: Retrieve the filters from the request object.
        $filters = $request->getQueryParams();
        //dd($filters); //? NOTE: inspect or output the received filters.

        // todo: validate the received pagination.
        //? Hint: both must be positive integers.
        //? We need to put this in the Base controller.
        //* Use built-in PHP functions:
        //* Option 1: 1) is_* [e.g, is_int($value)]
        //* Option 2: 2) RegEx(e.g., ^[-+]?\d+$)

        // $page = $filters["page"];
        // $page_size = $filters["page_size"];
        // $this->vendors_model->setPaginationOptions($page,$page_size);

        //* STEP 2: Pass the filters to the model.
        $vendors = $this->vendors_model->getVendors($filters);



        //$vendors = $this->vendors_model->getVendors([]);
        // var_dump ($vendors);
        // exit;

        // Convert array to JSON and return it.
        $payload = json_encode($vendors);
        $response->getBody()->write($payload);

        return $response->withHeader(
            HEADERS_CONTENT_TYPE,
            APP_MEDIA_TYPE_JSON
        );
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
