<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter Rest Controller
 * A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 * @version         3.0.0
 */
abstract class REST_Controller extends CI_Controller
{

    // Note: Only the widely used HTTP status codes are documented

    // Informational

    const HTTP_CONTINUE = 100;
    const HTTP_SWITCHING_PROTOCOLS = 101;
    const HTTP_PROCESSING = 102;            // RFC2518

    // Success

    /**
     * The request has succeeded
     */
    const HTTP_OK = 200;

    /**
     * The server successfully created a new resource
     */
    const HTTP_CREATED = 201;
    const HTTP_ACCEPTED = 202;
    const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;

    /**
     * The server successfully processed the request, though no content is returned
     */
    const HTTP_NO_CONTENT = 204;
    const HTTP_RESET_CONTENT = 205;
    const HTTP_PARTIAL_CONTENT = 206;
    const HTTP_MULTI_STATUS = 207;          // RFC4918
    const HTTP_ALREADY_REPORTED = 208;      // RFC5842
    const HTTP_IM_USED = 226;               // RFC3229

    // Redirection

    const HTTP_MULTIPLE_CHOICES = 300;
    const HTTP_MOVED_PERMANENTLY = 301;
    const HTTP_FOUND = 302;
    const HTTP_SEE_OTHER = 303;

    /**
     * The resource has not been modified since the last request
     */
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_USE_PROXY = 305;
    const HTTP_RESERVED = 306;
    const HTTP_TEMPORARY_REDIRECT = 307;
    const HTTP_PERMANENTLY_REDIRECT = 308;  // RFC7238

    // Client Error

    /**
     * The request cannot be fulfilled due to multiple errors
     */
    const HTTP_BAD_REQUEST = 400;

    /**
     * The user is unauthorized to access the requested resource
     */
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_PAYMENT_REQUIRED = 402;

    /**
     * The requested resource is unavailable at this present time
     */
    const HTTP_FORBIDDEN = 403;

    /**
     * The requested resource could not be found
     *
     * Note: This is sometimes used to mask if there was an UNAUTHORIZED (401) or
     * FORBIDDEN (403) error, for security reasons
     */
    const HTTP_NOT_FOUND = 404;

    /**
     * The request method is not supported by the following resource
     */
    const HTTP_METHOD_NOT_ALLOWED = 405;

    /**
     * The request was not acceptable
     */
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_REQUEST_TIMEOUT = 408;

    /**
     * The request could not be completed due to a conflict with the current state
     * of the resource
     */
    const HTTP_CONFLICT = 409;
    const HTTP_GONE = 410;
    const HTTP_LENGTH_REQUIRED = 411;
    const HTTP_PRECONDITION_FAILED = 412;
    const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
    const HTTP_REQUEST_URI_TOO_LONG = 414;
    const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const HTTP_EXPECTATION_FAILED = 417;
    const HTTP_I_AM_A_TEAPOT = 418;                                               // RFC2324
    const HTTP_UNPROCESSABLE_ENTITY = 422;                                        // RFC4918
    const HTTP_LOCKED = 423;                                                      // RFC4918
    const HTTP_FAILED_DEPENDENCY = 424;                                           // RFC4918
    const HTTP_RESERVED_FOR_WEBDAV_ADVANCED_COLLECTIONS_EXPIRED_PROPOSAL = 425;   // RFC2817
    const HTTP_UPGRADE_REQUIRED = 426;                                            // RFC2817
    const HTTP_PRECONDITION_REQUIRED = 428;                                       // RFC6585
    const HTTP_TOO_MANY_REQUESTS = 429;                                           // RFC6585
    const HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;                             // RFC6585

    // Server Error

    /**
     * The server encountered an unexpected error
     *
     * Note: This is a generic error message when no specific message
     * is suitable
     */
    const HTTP_INTERNAL_SERVER_ERROR = 500;

    /**
     * The server does not recognise the request method
     */
    const HTTP_NOT_IMPLEMENTED = 501;
    const HTTP_BAD_GATEWAY = 502;
    const HTTP_SERVICE_UNAVAILABLE = 503;
    const HTTP_GATEWAY_TIMEOUT = 504;
    const HTTP_VERSION_NOT_SUPPORTED = 505;
    const HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL = 506;                        // RFC2295
    const HTTP_INSUFFICIENT_STORAGE = 507;                                        // RFC4918
    const HTTP_LOOP_DETECTED = 508;                                               // RFC5842
    const HTTP_NOT_EXTENDED = 510;                                                // RFC2774
    const HTTP_NETWORK_AUTHENTICATION_REQUIRED = 511;

    /**
     * This defines the rest format
     * Must be overridden it in a controller so that it is set
     *
     * @var string|NULL
     */
    protected $rest_format = NULL;

    /**
     * Defines the list of method properties such as limit, log and level
     *
     * @var array
     */
    protected $methods = [];

    /**
     * List of allowed HTTP methods
     *
     * @var array
     */
    protected $allowed_http_methods = ['get', 'delete', 'post', 'put', 'options', 'patch', 'head'];

    /**
     * Contains details about the request
     * Fields: body, format, method, ssl
     * Note: This is a dynamic object (stdClass)
     *
     * @var object
     */
    protected $request = NULL;

    /**
     * Contains details about the response
     * Fields: format, lang
     * Note: This is a dynamic object (stdClass)
     *
     * @var object
     */
    protected $response = NULL;

    /**
     * Contains details about the REST API
     * Fields: db, ignore_limits, key, level, user_id
     * Note: This is a dynamic object (stdClass)
     *
     * @var object
     */
    protected $rest = NULL;

    /**
     * The arguments for the GET request method
     *
     * @var array
     */
    protected $_get_args = [];

    /**
     * The arguments for the POST request method
     *
     * @var array
     */
    protected $_post_args = [];

    /**
     * The arguments for the PUT request method
     *
     * @var array
     */
    protected $_put_args = [];

    /**
     * The arguments for the DELETE request method
     *
     * @var array
     */
    protected $_delete_args = [];

    /**
     * The arguments for the PATCH request method
     *
     * @var array
     */
    protected $_patch_args = [];

    /**
     * The arguments for the HEAD request method
     *
     * @var array
     */
    protected $_head_args = [];

    /**
     * The arguments for the OPTIONS request method
     *
     * @var array
     */
    protected $_options_args = [];

    /**
     * The arguments for the query parameters
     *
     * @var array
     */
    protected $_query_args = [];

    /**
     * The arguments from GET, POST, PUT, DELETE, PATCH, HEAD and OPTIONS request methods combined
     *
     * @var array
     */
    protected $_args = [];

    /**
     * The insert_id of the log entry (if we have one)
     *
     * @var string
     */
    protected $_insert_id = '';

    /**
     * If the request is allowed based on the API key provided
     *
     * @var bool
     */
    protected $_allow = TRUE;

    /**
     * The LDAP Distinguished Name of the User post authentication
     *
     * @var string
     */
    protected $_user_ldap_dn = '';

    /**
     * The start of the response time from the server
     *
     * @var number
     */
    protected $_start_rtime;

    /**
     * The end of the response time from the server
     *
     * @var number
     */
    protected $_end_rtime;

    /**
     * List all supported methods, the first will be the default format
     *
     * @var array
     */
    protected $_supported_formats = [
        'json' => 'application/json',
        'array' => 'application/json',
        'csv' => 'application/csv',
        'html' => 'text/html',
        'jsonp' => 'application/javascript',
        'php' => 'text/plain',
        'serialized' => 'application/vnd.php.serialized',
        'xml' => 'application/xml'
    ];

    /**
     * Information about the current API user
     *
     * @var object
     */
    protected $_apiuser;

    /**
     * Whether or not to perform a CORS check and apply CORS headers to the request
     *
     * @var bool
     */
    protected $check_cors = NULL;

    /**
     * Enable XSS flag
     * Determines whether the XSS filter is always active when
     * GET, OPTIONS, HEAD, POST, PUT, DELETE and PATCH data is encountered
     * Set automatically based on config setting
     *
     * @var bool
     */
    protected $_enable_xss = FALSE;

    private $is_valid_request = TRUE;

    /**
     * HTTP status codes and their respective description
     * Note: Only the widely used HTTP status codes are used
     *
     * @var array
     * @link http://www.restapitutorial.com/httpstatuscodes.html
     */
    protected $http_status_codes = [
        self::HTTP_OK => 'OK',
        self::HTTP_CREATED => 'CREATED',
        self::HTTP_NO_CONTENT => 'NO CONTENT',
        self::HTTP_NOT_MODIFIED => 'NOT MODIFIED',
        self::HTTP_BAD_REQUEST => 'BAD REQUEST',
        self::HTTP_UNAUTHORIZED => 'UNAUTHORIZED',
        self::HTTP_FORBIDDEN => 'FORBIDDEN',
        self::HTTP_NOT_FOUND => 'NOT FOUND',
        self::HTTP_METHOD_NOT_ALLOWED => 'METHOD NOT ALLOWED',
        self::HTTP_NOT_ACCEPTABLE => 'NOT ACCEPTABLE',
        self::HTTP_CONFLICT => 'CONFLICT',
        self::HTTP_INTERNAL_SERVER_ERROR => 'INTERNAL SERVER ERROR',
        self::HTTP_NOT_IMPLEMENTED => 'NOT IMPLEMENTED'
    ];

    /**
     * @var Format
     */
    private $format;
    /**
     * @var bool
     */

    /**
     * Extend this function to apply additional checking early on in the process
     *
     * @access protected
     * @return void
     */
    protected function early_checks()
    {
    }

    /**
     * Constructor for the REST API
     *
     * @access public
     * @param string $config Configuration filename minus the file extension
     * e.g: my_rest.php is passed as 'my_rest'
     */
    public function __construct($config = 'rest')
    {
        parent::__construct();

        $this->preflight_checks();

        // Set the default value of global xss filtering. Same approach as CodeIgniter 3
        $this->_enable_xss = ($this->config->item('global_xss_filtering') === TRUE);

        // Don't try to parse template variables like {elapsed_time} and {memory_usage}
        // when output is displayed for not damaging data accidentally
        $this->output->parse_exec_vars = FALSE;

        // Start the timer for how long the request takes
        $this->_start_rtime = microtime(TRUE);

        // Load the rest.php configuration file
        $this->get_local_config($config);

        // At present the library is bundled with REST_Controller 2.5+, but will eventually be part of CodeIgniter (no citation)
        if (class_exists('Format')) {
            $this->format = new Format();
        } else {
            $this->load->library('Format', NULL, 'libraryFormat');
            $this->format = $this->libraryFormat;
        }


        // Determine supported output formats from configuration
        $supported_formats = $this->config->item('rest_supported_formats');

        // Validate the configuration setting output formats
        if (empty($supported_formats)) {
            $supported_formats = [];
        }

        if (!is_array($supported_formats)) {
            $supported_formats = [$supported_formats];
        }

        // Now update $this->_supported_formats
        $this->_supported_formats = array_intersect_key($this->_supported_formats, array_flip($supported_formats));

        // Get the language
        $language = $this->config->item('rest_language');
        if ($language === NULL) {
            $language = 'english';
        }

        // Load the language file
        $this->lang->load('rest_controller', $language, FALSE, TRUE, __DIR__ . '/../');

        // Initialise the response, request and rest objects
        $this->request = new stdClass();
        $this->response = new stdClass();
        $this->rest = new stdClass();

        // Determine whether the connection is HTTPS
        $this->request->ssl = is_https();

        // How is this request being made? GET, POST, PATCH, DELETE, INSERT, PUT, HEAD or OPTIONS
        // $this->request->method = $this->_detect_method();

        // Check for CORS access request
        $check_cors = $this->config->item('check_cors');
        if ($check_cors === TRUE) {
            $this->_check_cors();
        }

        $this->request->format = $this->_detect_input_format();
        $this->response->format = $this->_detect_output_format();
    }

    protected function _detect_output_format()
    {
        // Concatenate formats to a regex pattern e.g. \.(csv|json|xml)
        $pattern = '/\.(' . implode('|', array_keys($this->_supported_formats)) . ')($|\/)/';
        $matches = [];

        // Check if a file extension is used e.g. http://example.com/api/index.json?param1=param2
        if (preg_match($pattern, $this->uri->uri_string(), $matches)) {
            return $matches[1];
        }

        // Get the format parameter named as 'format'
        if (isset($this->_get_args['format'])) {
            $format = strtolower($this->_get_args['format']);

            if (isset($this->_supported_formats[$format]) === TRUE) {
                return $format;
            }
        }

        // Get the HTTP_ACCEPT server variable
        $http_accept = $this->input->server('HTTP_ACCEPT');

        // Otherwise, check the HTTP_ACCEPT server variable
        if ($this->config->item('rest_ignore_http_accept') === FALSE && $http_accept !== NULL) {
            // Check all formats against the HTTP_ACCEPT header
            foreach (array_keys($this->_supported_formats) as $format) {
                // Has this format been requested?
                if (strpos($http_accept, $format) !== FALSE) {
                    if ($format !== 'html' && $format !== 'xml') {
                        // If not HTML or XML assume it's correct
                        return $format;
                    } elseif ($format === 'html' && strpos($http_accept, 'xml') === FALSE) {
                        // HTML or XML have shown up as a match
                        // If it is truly HTML, it wont want any XML
                        return $format;
                    } else if ($format === 'xml' && strpos($http_accept, 'html') === FALSE) {
                        // If it is truly XML, it wont want any HTML
                        return $format;
                    }
                }
            }
        }

        // Check if the controller has a default format
        if (empty($this->rest_format) === FALSE) {
            return $this->rest_format;
        }

        // Obtain the default format from the configuration
        return $this->_get_default_output_format();
    }

    /**
     * Gets the default format from the configuration. Fallbacks to 'json'
     * if the corresponding configuration option $config['rest_default_format']
     * is missing or is empty
     *
     * @access protected
     * @return string The default supported input format
     */
    protected function _get_default_output_format()
    {
        $default_format = (string) $this->config->item('rest_default_format');
        return $default_format === '' ? 'json' : $default_format;
    }

    /**
     * Get the input format e.g. json or xml
     *
     * @access protected
     * @return string|NULL Supported input format; otherwise, NULL
     */
    protected function _detect_input_format()
    {
        // Get the CONTENT-TYPE value from the SERVER variable
        $content_type = $this->input->server('CONTENT_TYPE');

        if (empty($content_type) === FALSE) {
            // If a semi-colon exists in the string, then explode by ; and get the value of where
            // the current array pointer resides. This will generally be the first element of the array
            $content_type = (strpos($content_type, ';') !== FALSE ? current(explode(';', $content_type)) : $content_type);

            // Check all formats against the CONTENT-TYPE header
            foreach ($this->_supported_formats as $type => $mime) {
                // $type = format e.g. csv
                // $mime = mime type e.g. application/csv

                // If both the mime types match, then return the format
                if ($content_type === $mime) {
                    return $type;
                }
            }
        }

        return NULL;
    }

    /**
     * @param $config_file
     */
    private function get_local_config($config_file)
    {
        if (file_exists(__DIR__ . "/../config/" . $config_file . ".php")) {
            $config = array();
            include(__DIR__ . "/../config/" . $config_file . ".php");

            foreach ($config as $key => $value) {
                $this->config->set_item($key, $value);
            }
        }

        $this->load->config($config_file, FALSE, TRUE);
    }

    /**
     * Checks to see if we have everything we need to run this library.
     *
     * @access protected
     * @throws Exception
     */
    protected function preflight_checks()
    {
        // Check to see if PHP is equal to or greater than 5.4.x
        if (is_php('5.4') === FALSE) {
            // CodeIgniter 3 is recommended for v5.4 or above
            throw new Exception('Using PHP v' . PHP_VERSION . ', though PHP v5.4 or greater is required');
        }

        // Check to see if this is CI 3.x
        if (explode('.', CI_VERSION, 2)[0] < 3) {
            throw new Exception('REST Server requires CodeIgniter 3.x');
        }
    }

    public function response($data = NULL, $http_code = NULL, $continue = FALSE)
    {
        ob_start();
        // If the HTTP status is not NULL, then cast as an integer
        if ($http_code !== NULL) {
            // So as to be safe later on in the process
            $http_code = (int) $http_code;
        }

        // Set the output as NULL by default
        $output = NULL;

        // If data is NULL and no HTTP status code provided, then display, error and exit
        if ($data === NULL && $http_code === NULL) {
            $http_code = self::HTTP_NOT_FOUND;
        }

        // If data is not NULL and a HTTP status code provided, then continue
        elseif ($data !== NULL) {
            // If the format method exists, call and return the output in that format
            if (method_exists($this->format, 'to_' . $this->response->format)) {
                // Set the format header
                $_supported_formats = [
                    'json' => 'application/json',
                    'array' => 'application/json',
                    'csv' => 'application/csv',
                    'html' => 'text/html',
                    'jsonp' => 'application/javascript',
                    'php' => 'text/plain',
                    'serialized' => 'application/vnd.php.serialized',
                    'xml' => 'application/xml'
                ];

                $this->output->set_content_type($_supported_formats[$this->response->format], strtolower($this->config->item('charset')));
                $output = $this->format->factory($data)->{'to_' . $this->response->format}();

                // An array must be parsed as a string, so as not to cause an array to string error
                // Json is the most appropriate form for such a data type
                if ($this->response->format === 'array') {
                    $output = $this->format->factory($output)->{'to_json'}();
                }
            } else {
                // If an array or object, then parse as a json, so as to be a 'string'
                if (is_array($data) || is_object($data)) {
                    $data = $this->format->factory($data)->{'to_json'}();
                }

                // Format is not supported, so output the raw data as a string
                $output = $data;
            }
        }

        // If not greater than zero, then set the HTTP status code as 200 by default
        // Though perhaps 500 should be set instead, for the developer not passing a
        // correct HTTP status code
        $http_code > 0 || $http_code = self::HTTP_OK;

        $this->output->set_status_header($http_code);

        // Output the data
        $this->output->set_output($output);

        if ($continue === FALSE) {
            // Display the data and exit execution
            $this->output->_display();
            exit;
        } else {
            ob_end_flush();
        }

        // Otherwise dump the output automatically
    }

    /**
     * Takes mixed data and optionally a status code, then creates the response
     * within the buffers of the Output class. The response is sent to the client
     * lately by the framework, after the current controller's method termination.
     * All the hooks after the controller's method termination are executable
     *
     * @access public
     * @param array|NULL $data Data to output to the user
     * @param int|NULL $http_code HTTP status code
     */
    public function set_response($data = NULL, $http_code = NULL)
    {
        $this->response($data, $http_code, TRUE);
    }

    protected function _check_cors()
    {
        // Convert the config items into strings
        $allowed_headers = implode(', ', $this->config->item('allowed_cors_headers'));
        $allowed_methods = implode(', ', $this->config->item('allowed_cors_methods'));

        // If we want to allow any domain to access the API
        if ($this->config->item('allow_any_cors_domain') === TRUE) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: ' . $allowed_headers);
            header('Access-Control-Allow-Methods: ' . $allowed_methods);
        } else {
            // We're going to allow only certain domains access
            // Store the HTTP Origin header
            $origin = $this->input->server('HTTP_ORIGIN');
            if ($origin === NULL) {
                $origin = '';
            }

            // If the origin domain is in the allowed_cors_origins list, then add the Access Control headers
            if (in_array($origin, $this->config->item('allowed_cors_origins'))) {
                header('Access-Control-Allow-Origin: ' . $origin);
                header('Access-Control-Allow-Headers: ' . $allowed_headers);
                header('Access-Control-Allow-Methods: ' . $allowed_methods);
            }
        }

        // If the request HTTP method is 'OPTIONS', kill the response and send it to the client
        if ($this->input->method() === 'options') {
            exit;
        }
    }
}
