# REST API Assignment Tutorial - Complete Guide

## Table of Contents
1. [Understanding REST APIs](#understanding-rest-apis)
2. [PHP Basics for This Project](#php-basics)
3. [Understanding the Slim Framework](#slim-framework)
4. [Database Relationships](#database-relationships)
5. [Implementation Guide](#implementation-guide)
6. [Sub-Collection Pattern](#sub-collection-pattern)
7. [Filter Implementation](#filter-implementation)
8. [Complete Implementation Reference](#complete-implementation-reference)

---

## Understanding REST APIs

### What is REST?
REST (Representational State Transfer) is an architectural style for designing networked applications. Think of it as a set of rules for how web services should communicate.

**Key Concepts:**
- **Resources**: Everything is a resource (vendors, keyboards, mice). Each resource has a unique URI.
- **HTTP Methods**: We use GET to retrieve data (this assignment only uses GET).
- **Stateless**: Each request contains all information needed to process it.
- **JSON Format**: Data is exchanged in JSON format (JavaScript Object Notation).

### Resource Types

**1. Collection Resource** (Plural name)
- Represents multiple items of the same type
- Example: `/vendors` returns a list of all vendors
- Example: `/keyboards` returns a list of all keyboards

**2. Singleton Resource** (Singular with ID)
- Represents a single specific item
- Example: `/vendors/5` returns vendor with ID 5
- Example: `/keyboards/12` returns keyboard with ID 12

**3. Sub-Collection Resource**
- Represents items that belong to a parent resource
- Example: `/vendors/5/switches` returns all switches made by vendor 5
- Example: `/mice/3/buttons` returns all buttons on mouse 3

---

## PHP Basics for This Project

### PHP Syntax Essentials

```php
<?php
// This tag starts PHP code

// Variables start with $
$name = "John";
$age = 25;

// Arrays (like lists in other languages)
$simple_array = [1, 2, 3];
$assoc_array = ["name" => "John", "age" => 25]; // Key-value pairs

// Functions
function greet($name) {
    return "Hello, " . $name; // . concatenates strings
}

// Classes and Objects
class Person {
    private $name; // Property
    
    public function __construct($name) { // Constructor
        $this->name = $name; // $this refers to current object
    }
    
    public function getName() { // Method
        return $this->name;
    }
}

$person = new Person("John");
echo $person->getName(); // Outputs: John
```

### Important PHP Concepts for This Project

**1. Type Declarations**
```php
// Strict typing (at top of file)
declare(strict_types=1);

// Function with type hints
function getVendor(int $id): array {
    // $id must be integer, returns array
}
```

**2. Namespaces** (Organize code into logical groups)
```php
namespace App\Controllers; // This file belongs to Controllers namespace

use App\Domain\Models\VendorsModel; // Import from another namespace
```

**3. Arrays in PHP**
```php
// Indexed array
$fruits = ["apple", "banana", "orange"];
echo $fruits[0]; // "apple"

// Associative array (like a dictionary/map)
$person = [
    "name" => "John",
    "age" => 25,
    "city" => "Montreal"
];
echo $person["name"]; // "John"

// Checking if key exists
if (isset($filters["name"])) {
    // Key exists
}

// Checking if not empty
if (!empty($filters["name"])) {
    // Key exists AND has a value
}
```

---

## Slim Framework

### What is Slim?
Slim is a PHP micro-framework for building web applications and APIs. It handles routing, requests, and responses.

### How Routing Works

```php
// In routes.php
$app->get('/vendors', [VendorsController::class, 'handleGetVendors']);
//       ↑           ↑                                ↑
//    HTTP Method   URI Path                    Controller Method
```

**Breaking it down:**
1. `$app->get()` - Defines a route that responds to GET requests
2. `'/vendors'` - The URI path (URL endpoint)
3. `[VendorsController::class, 'handleGetVendors']` - Which method to call

### Request and Response Objects

**Request Object** - Contains information about the HTTP request
```php
public function handleGetVendors(Request $request, Response $response): Response
{
    // Get query parameters (?name=Cherry&country=Germany)
    $filters = $request->getQueryParams();
    // $filters = ["name" => "Cherry", "country" => "Germany"]
    
    // Get URI parameters (/vendors/{vendor_id})
    $vendor_id = $uri_args["vendor_id"];
}
```

**Response Object** - What we send back to the client
```php
// Create JSON response
$data = ["name" => "Cherry", "country" => "Germany"];
$payload = json_encode($data);
$response->getBody()->write($payload);
return $response->withHeader('Content-Type', 'application/json');
```

---

## Database Relationships

### Understanding the Schema

Let's visualize the key relationships:

```
vendors (1) ----< (many) switches
   |                        |
   |                        |
   +----< keyboards >-------+
            |
            |
         layouts
```

**One-to-Many Relationships:**
- One vendor can make many switches
- One vendor can make many keyboards
- One switch can be used in many keyboards
- One layout can be used in many keyboards

### SQL Joins Explained

**INNER JOIN** - Only returns rows where there's a match in both tables
```sql
SELECT k.*, v.name as vendor_name
FROM keyboards k
INNER JOIN vendors v ON k.vendor_id = v.vendor_id
-- Only keyboards that have a matching vendor
```

**LEFT JOIN** - Returns all rows from left table, even if no match
```sql
SELECT v.*, COUNT(s.switch_id) as switch_count
FROM vendors v
LEFT JOIN switches s ON v.vendor_id = s.vendor_id
GROUP BY v.vendor_id
-- All vendors, even those with 0 switches
```

---

## Implementation Guide

### Step-by-Step: Creating an Endpoint

Let's implement `/keyboards` endpoint as an example.

#### Step 1: Create the Model

```php
// app/Domain/Models/KeyboardsModel.php
<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Helpers\Core\PDOService;

class KeyboardsModel extends BaseModel
{
    public function __construct(private PDOService $pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * Retrieves keyboards with optional filtering
     * 
     * @param array $filters Associative array of filter parameters
     * @return array Paginated result with meta and data
     */
    public function getKeyboards(array $filters): array
    {
        // Start with base query
        $sql = "SELECT k.*, v.name as vendor_name, s.name as switch_name, l.name as layout_name
                FROM keyboards k
                INNER JOIN vendors v ON k.vendor_id = v.vendor_id
                INNER JOIN switches s ON k.switch_id = s.switch_id
                INNER JOIN layouts l ON k.layout_id = l.layout_id
                WHERE 1=1"; // WHERE 1=1 is a trick to easily add AND conditions
        
        $pdo_values = []; // Will hold values for prepared statement
        
        // Filter by switch type
        if (!empty($filters["switch_type"])) {
            $sql .= " AND s.type = :switch_type";
            $pdo_values["switch_type"] = $filters["switch_type"];
        }
        
        // Filter by connectivity
        if (!empty($filters["connectivity"])) {
            $sql .= " AND k.connectivity = :connectivity";
            $pdo_values["connectivity"] = $filters["connectivity"];
        }
        
        // Filter by hot-swappable (boolean)
        if (isset($filters["hot_swappable"])) {
            $sql .= " AND k.hot_swappable = :hot_swappable";
            // Convert string "true"/"false" to 1/0
            $pdo_values["hot_swappable"] = filter_var($filters["hot_swappable"], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        }
        
        // Filter by weight maximum
        if (!empty($filters["weight_max"])) {
            $sql .= " AND k.weight <= :weight_max";
            $pdo_values["weight_max"] = $filters["weight_max"];
        }
        
        // Filter by release date range
        if (!empty($filters["release_date_after"])) {
            $sql .= " AND k.release_date >= :release_date_after";
            $pdo_values["release_date_after"] = $filters["release_date_after"];
        }
        
        if (!empty($filters["release_date_before"])) {
            $sql .= " AND k.release_date <= :release_date_before";
            $pdo_values["release_date_before"] = $filters["release_date_before"];
        }
        
        // Return paginated results
        return $this->paginate($sql, $pdo_values);
    }
    
    /**
     * Retrieves a single keyboard by ID
     * 
     * @param int $keyboard_id The keyboard ID
     * @return mixed The keyboard data or false if not found
     */
    public function findKeyboardById(int $keyboard_id): mixed
    {
        $sql = "SELECT k.*, v.name as vendor_name, s.name as switch_name, l.name as layout_name
                FROM keyboards k
                INNER JOIN vendors v ON k.vendor_id = v.vendor_id
                INNER JOIN switches s ON k.switch_id = s.switch_id
                INNER JOIN layouts l ON k.layout_id = l.layout_id
                WHERE k.keyboard_id = :keyboard_id";
        
        return $this->fetchSingle($sql, ["keyboard_id" => $keyboard_id]);
    }
}
```

#### Step 2: Create the Controller

```php
// app/Controllers/KeyboardsController.php
<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Domain\Models\KeyboardsModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class KeyboardsController extends BaseController
{
    public function __construct(private KeyboardsModel $keyboards_model) {}
    
    /**
     * Handles GET /keyboards
     * Returns a paginated list of keyboards with optional filters
     */
    public function handleGetKeyboards(Request $request, Response $response): Response
    {
        // Step 1: Get filters from query string
        $filters = $request->getQueryParams();
        
        // Step 2: Pass filters to model
        $keyboards = $this->keyboards_model->getKeyboards($filters);
        
        // Step 3: Return JSON response
        return $this->renderJson($response, $keyboards);
    }
    
    /**
     * Handles GET /keyboards/{keyboard_id}
     * Returns a single keyboard by ID
     */
    public function handleGetKeyboardById(
        Request $request,
        Response $response,
        array $uri_args
    ): Response {
        // Step 1: Get ID from URI
        $keyboard_id = (int) $uri_args["keyboard_id"];
        
        // Step 2: Fetch from database
        $keyboard = $this->keyboards_model->findKeyboardById($keyboard_id);
        
        // Step 3: Handle not found
        if ($keyboard === false) {
            $error = [
                "status" => "error",
                "code" => 404,
                "message" => "Keyboard not found with ID: " . $keyboard_id
            ];
            return $this->renderJson($response, $error, 404);
        }
        
        // Step 4: Return success response
        return $this->renderJson($response, $keyboard);
    }
}
```

#### Step 3: Register the Routes

```php
// app/Routes/routes.php
use App\Controllers\KeyboardsController;

// Add these lines
$app->get('/keyboards', [KeyboardsController::class, 'handleGetKeyboards']);
$app->get('/keyboards/{keyboard_id}', [KeyboardsController::class, 'handleGetKeyboardById']);
```

---

## Sub-Collection Pattern

### What is a Sub-Collection?

A sub-collection represents items that belong to a parent resource.

**Example:** `/vendors/5/switches`
- Parent: vendor with ID 5
- Sub-collection: all switches made by that vendor

### The Three-Step Pattern

Your teacher provided this pattern. Let's understand it:

```php
public function getSwitchesByVendorId(int $vendor_id): mixed
{
    // STEP 1: Fetch the parent resource
    // Why? To verify it exists and include its details in response
    $vendor = $this->findVendorById($vendor_id);
    
    if ($vendor === false) {
        return false; // Parent doesn't exist
    }
    
    // STEP 2: Fetch the sub-collection items
    $switches_query = "
        SELECT s.*, v.name as vendor_name
        FROM switches s
        INNER JOIN vendors v ON s.vendor_id = v.vendor_id
        WHERE s.vendor_id = :vendor_id
    ";
    
    $switches = $this->paginate($switches_query, ["vendor_id" => $vendor_id]);
    
    // STEP 3: Structure the response
    $results = [
        "vendor" => $vendor,        // Parent resource
        "meta" => $switches["meta"], // Pagination info
        "switches" => $switches["data"] // Sub-collection items
    ];
    
    return $results;
}
```

### Why This Structure?

**Benefits:**
1. **Context**: Client knows which vendor these switches belong to
2. **Verification**: Confirms parent exists before showing children
3. **Consistency**: All sub-collection responses follow same pattern
4. **Pagination**: Meta data helps client navigate large result sets

**Response Example:**
```json
{
  "vendor": {
    "vendor_id": 5,
    "name": "Cherry",
    "country": "Germany"
  },
  "meta": {
    "total": 15,
    "current_page": 1,
    "page_size": 10,
    "total_pages": 2
  },
  "switches": [
    {
      "switch_id": 1,
      "name": "MX Red",
      "type": "Linear"
    },
    ...
  ]
}
```

---

## Filter Implementation

### Understanding Range Filters

Range filters allow filtering by minimum and maximum values.

**Query String Format:**
```
?actuation_force.min=45&actuation_force.max=60
```

**Implementation:**
```php
// In your model method
if (!empty($filters["actuation_force_min"])) {
    $sql .= " AND s.actuation_force >= :actuation_force_min";
    $pdo_values["actuation_force_min"] = $filters["actuation_force_min"];
}

if (!empty($filters["actuation_force_max"])) {
    $sql .= " AND s.actuation_force <= :actuation_force_max";
    $pdo_values["actuation_force_max"] = $filters["actuation_force_max"];
}
```

### Understanding Count Minimum Filters

These filters require aggregation (counting related items).

**Example:** Find vendors who make at least 10 switches

\`\`\`php
public function getVendors(array $filters): array
{
    $sql = "SELECT v.*, COUNT(s.switch_id) as switch_count
            FROM vendors v
            LEFT JOIN switches s ON v.vendor_id = s.vendor_id
            WHERE 1=1";
    
    $pdo_values = [];
    
    // Add other filters here...
    
    // Group by vendor (required for COUNT)
    $sql .= " GROUP BY v.vendor_id";
    
    // Filter by switch count minimum
    if (!empty($filters["switch_count_min"])) {
        $sql .= " HAVING COUNT(s.switch_id) >= :switch_count_min";
        $pdo_values["switch_count_min"] = $filters["switch_count_min"];
    }
    
    return $this->paginate($sql, $pdo_values);
}
```

**Key Points:**
- Use `LEFT JOIN` to include vendors with 0 switches
- `GROUP BY` is required when using aggregate functions
- `HAVING` filters aggregated results (use after GROUP BY)
- `WHERE` filters individual rows (use before GROUP BY)

### Date Range Filters

```php
// Filter by release date range
if (!empty($filters["release_date_after"])) {
    $sql .= " AND k.release_date >= :release_date_after";
    $pdo_values["release_date_after"] = $filters["release_date_after"];
}

if (!empty($filters["release_date_before"])) {
    $sql .= " AND k.release_date <= :release_date_before";
    $pdo_values["release_date_before"] = $filters["release_date_before"];
}
```

**Usage:**
```
GET /keyboards?release_date_after=2020-01-01&release_date_before=2023-12-31
```

---

## Testing with Thunder Client

### Basic GET Request
1. Open Thunder Client in VS Code
2. Create new request
3. Set method to GET
4. Enter URL: `http://localhost/km-api/vendors`
5. Click Send

### Testing with Filters
```
http://localhost/km-api/keyboards?switch_type=Linear&hot_swappable=true
```

### Testing Pagination
```
http://localhost/km-api/vendors?page=2&page_size=10
```

### Testing Sub-Collections
```
http://localhost/km-api/vendors/5/switches
```

---

## Common Mistakes to Avoid

1. **Forgetting WHERE 1=1**
   - Makes it easy to add AND conditions dynamically
   
2. **Not using prepared statements**
   - Always use `:parameter` syntax to prevent SQL injection
   
3. **Mixing WHERE and HAVING**
   - WHERE: filters rows before grouping
   - HAVING: filters groups after aggregation
   
4. **Forgetting to check if parent exists**
   - Always verify parent resource exists in sub-collections
   
5. **Not handling empty results**
   - Return appropriate 404 status when resource not found

---

## Summary

**Key Takeaways:**
1. REST APIs expose resources through URIs
2. Controllers handle requests, Models handle database
3. Sub-collections follow a three-step pattern
4. Filters are applied in SQL WHERE/HAVING clauses
5. Always use prepared statements for security
6. Return proper HTTP status codes

**Next Steps:**
1. Implement remaining endpoints following the patterns shown
2. Test each endpoint with Thunder Client
3. Add proper error handling
4. Document your code with PHPDoc comments

Good luck with your assignment!

---

## Complete Implementation Reference

I have implemented **all 9 required endpoints** for your assignment. Below is a summary of what has been created:

### Implemented Endpoints

#### 1. `/vendors` - Collection Resource
- **File**: `app/Controllers/VendorsController.php` (method: `handleGetVendors`)
- **Model**: `app/Domain/Models/VendorsModel.php` (method: `getVendors`)
- **Filters Implemented**:
  - Country
  - Founded after year
  - Founded before year
  - Keyboard count minimum (aggregate filter)
  - Average keyboard price range

#### 2. `/vendors/{vendor_id}` - Singleton Resource
- **File**: `app/Controllers/VendorsController.php` (method: `handleGetVendorById`)
- **Model**: `app/Domain/Models/VendorsModel.php` (method: `findVendorById`)
- Returns single vendor details

#### 3. `/vendors/{vendor_id}/switches` - Sub-Collection Resource
- **File**: `app/Controllers/VendorsController.php` (method: `handleGetSwitchesByVendorId`)
- **Model**: `app/Domain/Models/VendorsModel.php` (method: `getSwitchesByVendorId`)
- **Filters Implemented**:
  - Type (Linear, Tactile, Clicky)
  - Actuation force range (.min and .max)
  - Travel distance range
  - Lifespan minimum
  - Release date range
- **Pattern**: Follows the three-step sub-collection pattern your teacher specified

#### 4. `/keyboards` - Collection Resource
- **File**: `app/Controllers/KeyboardsController.php` (method: `handleGetKeyboards`)
- **Model**: `app/Domain/Models/KeyboardsModel.php` (method: `getKeyboards`)
- **Filters Implemented**:
  - Switch type
  - Connectivity (Wired, Wireless, Both)
  - Hot-swappable (boolean)
  - Weight maximum
  - Release date range
  - PCB firmware type

#### 5. `/keyboards/{keyboard_id}` - Singleton Resource
- **File**: `app/Controllers/KeyboardsController.php` (method: `handleGetKeyboardById`)
- **Model**: `app/Domain/Models/KeyboardsModel.php` (method: `findKeyboardById`)
- Returns single keyboard details

#### 6. `/mice` - Collection Resource
- **File**: `app/Controllers/MiceController.php` (method: `handleGetMice`)
- **Model**: `app/Domain/Models/MiceModel.php` (method: `getMice`)
- **Filters Implemented**:
  - Polling rate (125, 500, 1000 Hz)
  - Connection (Wired, Wireless, Both)
  - Weight range (.min and .max)
  - Price range (.min and .max)
  - Button count minimum
  - Average rating minimum

#### 7. `/mice/{mouse_id}/buttons` - Sub-Collection Resource
- **File**: `app/Controllers/MiceController.php` (method: `handleGetButtonsByMouseId`)
- **Model**: `app/Domain/Models/MiceModel.php` (method: `getButtonsByMouseId`)
- **Filters Implemented**:
  - Programmable (boolean)
  - Button name (exact match)
  - Name contains text (partial match)
- **Pattern**: Follows the three-step sub-collection pattern

#### 8. `/layouts/{layout_id}/keyboards` - Sub-Collection Resource
- **File**: `app/Controllers/LayoutsController.php` (method: `handleGetKeyboardsByLayoutId`)
- **Model**: `app/Domain/Models/KeyboardsModel.php` (method: `getKeyboardsByLayoutId`)
- **Filters Implemented**:
  - Switch type
  - Price range (.min and .max)
  - Connectivity type
- **Pattern**: Follows the three-step sub-collection pattern

#### 9. `/layouts/{layout_id}/keycap-sets` - Sub-Collection Resource
- **File**: `app/Controllers/LayoutsController.php` (method: `handleGetKeycapSetsByLayoutId`)
- **Model**: `app/Domain/Models/KeycapSetsModel.php` (method: `getKeycapSetsByLayoutId`)
- **Filters Implemented**:
  - Material
  - Profile
  - Price maximum
  - Manufacturer
- **Pattern**: Follows the three-step sub-collection pattern

### Routes Configuration

All routes have been added to `app/Routes/routes.php`. Make sure to review this file to see how each endpoint is registered with the Slim application.

### Additional Files Created

1. **TESTING_GUIDE.md** - Comprehensive testing instructions with example requests for every endpoint
2. **Custom Exception Classes** - Located in `app/Exceptions/` (if needed for advanced error handling)

### How to Use These Files

1. **Study the Tutorial**: Read through this TUTORIAL.md file to understand the concepts
2. **Examine the Code**: Open each controller and model file to see how the patterns are applied
3. **Test the Endpoints**: Use the TESTING_GUIDE.md to test each endpoint with Thunder Client
4. **Understand the Patterns**: Notice how:
   - Collection resources use pagination
   - Singleton resources return single items
   - Sub-collections follow the three-step pattern
   - Filters are applied consistently across endpoints
   - All code uses PHPDoc comments

### Learning Path Recommendation

1. **Start with Simple Endpoints**: Begin by understanding `/vendors` and `/vendors/{vendor_id}`
2. **Move to Sub-Collections**: Study `/vendors/{vendor_id}/switches` to understand the pattern
3. **Understand Filters**: Look at how range filters and count filters are implemented
4. **Test Everything**: Use Thunder Client to test each endpoint with various filter combinations
5. **Read the Code**: Don't just copy - read through each method and understand what it does

### Key Files to Review

- **BaseModel.php**: Contains pagination logic used by all models
- **BaseController.php**: Contains common controller methods like `renderJson()`
- **routes.php**: Shows how all endpoints are registered
- **VendorsModel.php**: Good example of complex filters including aggregates
- **KeyboardsModel.php**: Shows sub-collection implementation

---


