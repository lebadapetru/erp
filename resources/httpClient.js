import axios from 'axios'
//import NProgress from 'nprogress' /*TODO vue3 progress bar.. remove this*/
import Swal from 'sweetalert2'

let token = document.head.querySelector('meta[name="csrf-token"]')

const httpClient = axios.create({
  baseURL: `http://erp.local:80`,
  withCredentials: true,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': token ? token.content : null
  }
})

httpClient.interceptors.request.use(function (config) {
  //NProgress.start()
  console.log(config)

  return config;
}, function (error) {
  console.log(error)

  return Promise.reject(error);
});

httpClient.interceptors.response.use(function (response) {
  //NProgress.done()
  //handleResponse(response)

  return response;
}, function (error) {
  //NProgress.done()
  handleResponse(error.response)

  return Promise.reject(error);
});

function handleResponse(response){
  let status = response ? response.status : null;
  let codes = statusCodes();

  if(!status || !codes[status]){
    return false;
  }

  Swal.fire({
    text: response.data.message,
    icon: "error",
    buttonsStyling: false,
    confirmButtonText: "Ok, got it!",
    customClass: {
      confirmButton: "btn font-weight-bold btn-light-primary"
    },
    heightAuto: false
  })

  return true;
}

function statusCodes(){
  return {
    '100': 'Continue',
    '101': 'Switching Protocols',
    '102': 'Processing',

    '200': 'OK',
    '201': 'Created',
    '202': 'Accepted',
    '203': 'Non-authoritative Information',
    '204': 'No Content',
    '205': 'Reset Content',
    '206': 'Partial Content',
    '207': 'Multi-Status',
    '208': 'Already Reported',
    '226': 'IM Used',

    '300': 'Multiple Choices',
    '301': 'Moved Permanently',
    '302': 'Found',
    '303': 'See Other',
    '304': 'Not Modified',
    '305': 'Use Proxy',
    '307': 'Temporary Redirect',
    '308': 'Permanent Redirect',

    '400': 'Bad Request',
    '401': 'Unauthorized',
    '402': 'Payment Required',
    '403': 'Forbidden',
    '404': 'Not Found',
    '405': 'Method Not Allowed',
    '406': 'Not Acceptable',
    '407': 'Proxy Authentication Required',
    '408': 'Request Timeout',
    '409': 'Conflict',
    '410': 'Gone',
    '411': 'Length Required',
    '412': 'Precondition Failed',
    '413': 'Payload Too Large',
    '414': 'Request-URI Too Long',
    '415': 'Unsupported Media Type',
    '416': 'Requested Range Not Satisfiable',
    '417': 'Expectation Failed',
    '418': 'I\'m a teapot',
    '421': 'Misdirected Request',
    '422': 'Unprocessable Entity',
    '423': 'Locked',
    '424': 'Failed Dependency',
    '426': 'Upgrade Required',
    '428': 'Precondition Required',
    '429': 'Too Many Requests',
    '431': 'Request Header Fields Too Large',
    '444': 'Connection Closed Without Response',
    '451': 'Unavailable For Legal Reasons',
    '499': 'Client Closed Request',

    '500': 'Internal Server Error',
    '501': 'Not Implemented',
    '502': 'Bad Gateway',
    '503': 'Service Unavailable',
    '504': 'Gateway Timeout',
    '505': 'HTTP Version Not Supported',
    '506': 'letiant Also Negotiates',
    '507': 'Insufficient Storage',
    '508': 'Loop Detected',
    '510': 'Not Extended',
    '511': 'Network Authentication Required',
    '599': 'Network Connect Timeout Error',
  };
}

window.httpClient = httpClient