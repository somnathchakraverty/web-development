<?php
namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    use Config;

    protected $details;

    protected $validIPs = [
        '115.249.178.64', '115.249.178.65', '115.249.178.66', '115.249.178.67',
        '115.249.178.68', '115.249.178.69', '115.249.178.70', '115.249.178.71',
        '125.63.68.184', '125.63.68.185', '125.63.68.186', '125.63.68.187',
        '125.63.68.188', '125.63.68.189', '125.63.68.190', '125.63.68.191',
        '182.73.197.192','182.73.197.193','182.73.197.194','182.73.197.195',
        '182.73.197.196','182.73.197.197','182.73.197.198','182.73.197.199',
        '182.75.40.204', '182.75.40.205', '182.75.40.206', '182.75.40.207',
        '172.31.12.223', '172.31.16.138', '125.63.72.234', '125.63.72.235',
        '125.63.72.236', '125.63.72.237', '125.63.72.238', '127.0.0.1',
        '172.31.7.210',  // MS002 IP for Kong
        '172.31.12.32', // AGW001 IP for Kong
        '182.76.167.22'
    ];

    protected $isValidRequest = true;

    public function __construct()
    {

        $remoteAddress = request()->ip();

        if( ! in_array( $remoteAddress, $this->validIPs ) )
        {
            $this->isValidRequest = false;
        }

        $this->details = $this;

        $this->details->streamingFiles = [
            [ 'file' => __DIR__.'/../../../doctor/assets/linux-dash/index.php', 'mime' => NULL ],
            [ 'file' => __DIR__.'/../../../doctor/assets/linux-dash/linuxDash.min.js', 'mime' => 'application/javascript' ],
            [ 'file' => __DIR__.'/../../../doctor/assets/linux-dash/linuxDash.min.css', 'mime' => 'text/css' ],
            [ 'file' => __DIR__.'/../../../doctor/assets/linux-dash/linux_json_api.sh', 'mime' => NULL ]
        ];
        $this->details->baseURL = route('home');
        $this->details->siteURL = route('home');
        $this->details->currentURL = request()->url();
        $this->details->serverHostName = gethostname();
        $this->details->phpVersion = phpversion();
        $this->details->environment = env('APP_ENV');
        $this->details->crm_url = env('CRM_URL');
        $this->details->api_url = env('API_URL');
        $this->details->gitBranch = exec( $this->details->cmd, $this->details->output, $this->details->outputRetVal );
        // Cf. https://git-scm.com/book/en/v2/Git-Basics-Viewing-the-Commit-History
        $default = config('database.default');
        $db = config('database.connections.'.$default);
        
        $this->details->committersAndAuthors = shell_exec('git log --pretty=format:'.$this->details->committersAndAuthorsFormat.' -n 10');
        $this->details->dbHostName = $db['host'];
        $this->details->dbUserName = $db['username'];
        $this->details->dbName = $db['database'];
        $this->details->dbPort = $db['port'];
        $this->details->cronFileExists = file_exists(__DIR__.'/../../cron/database.php');
        if( $this->details->cronFileExists )
        {
            include_once __DIR__.'/../../cron/database.php';
            $this->details->cronDBHostName = $db['hostname'];
            $this->details->cronDBUserName = $db['username'];
            $this->details->cronDBPassword = $db['password'];
            $this->details->cronDBName = $db['database'];
            $this->details->cronDBPort = (isset($db['port'])?$db['port']:3306);

            $this->details->cronOldDBHostName = (isset($db['old_hostname'])?$db['old_hostname']:"");
            $this->details->cronOldDBUserName = (isset($db['old_username'])?$db['old_username']:"");
            $this->details->cronOldDBPassword = (isset($db['old_password'])?$db['old_password']:"");
            $this->details->cronOldDBName = (isset($db['old_database'])?$db['old_database']:"");
            $this->details->cronOldDBPort = (isset($db['old_port'])?$db['old_port']:3306);
        }
        else
        {
            $this->details->cronDBHostName = NULL;
            $this->details->cronDBUserName = NULL;
            $this->details->cronDBPassword = NULL;
            $this->details->cronDBName = NULL;

            $this->details->cronOldDBHostName = NULL;
            $this->details->cronOldDBUserName = NULL;
            $this->details->cronOldDBPassword = NULL;
            $this->details->cronOldDBName = NULL;
        }
        //$this->auth();

        $this->htmlHeader = <<<htmlHeader01
	<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="UTF-8">
				<meta http-equiv="Content-Language" content="en">
				<title>Server and Environment Details for {$this->details->baseURL}</title>
				<!-- Latest compiled and minified CSS -->
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

				<!-- Optional theme -->
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

				<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

				<!-- Latest compiled and minified JavaScript -->
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
				<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
				<style>
				.poiret-font { font-family: 'Poiret One', cursive; }
				.bootstarp-code-font { font-family: Menlo,Monaco,Consolas,"Courier New",monospace; }
				.text { font-size: 12px; }
				.h1 { font-size: 12px; font-weight: bold; }
				</style>
			</head>
htmlHeader01;
    }

    protected function auth()
    {
        $this->load->config('infra_auth');
        if ( $this->input->server('PHP_AUTH_USER') == $this->config->item('infra_auth_pass') )
        {
            header('WWW-Authenticate: Basic realm="Healthians Server Classified Access 009"');
            header('HTTP/1.0 401 Unauthorized');
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
        else
        {
            //if( isset() )
            return TRUE;
        }
    }

    public function index()
    {
        if( $this->isValidRequest === false )
        {
            if( !app()->runningInConsole() )
            {
                return response()->json(['response_code' => '401'],401, ['X-Remote-IP: '.request()->ip()]);
            }
            else
            {
                echo PHP_EOL.'HTTP/1.0 401 Unauthorized';
                echo PHP_EOL.'HTTP/1.1 401 Unauthorized'.PHP_EOL;
                dd("end");
            }
        }

        if( request()->has('phpinfo') )
        {
            $this->phpinfo();
        }
        elseif( request()->has('refreshGrants') )
        {
            return $this->refreshGrants();
        }
        elseif(request()->has('listTables'))
        {
            return $this->refreshTables();
        }

        $response = '';

        $isCLI = app()->runningInConsole();

        if( !$isCLI )
        {
            $remoteAddress = request()->ip();
            $response = $this->htmlHeader;
            $response .= <<<hd1
            <body class="bootstarp-code-font">
                <div class="container-fluid text">
                    <div class="col-md-8 table-responsive">
                        <table class="table">
                            <tr>
                                <td>
                                    <table class="table table-bordered table-striped table-hover">
                                        <tr><th>BASE URL</th><td><code>{$this->details->baseURL}</code></td></tr>
                                        <tr><th>SITE URL</th><td><code>{$this->details->siteURL}</code></td></tr>
                                        <tr><th>CURRENT URL</th><td><code>{$this->details->currentURL}</code></td></tr>
                                        <tr><th>Server Hostname</th><td><code>{$this->details->serverHostName}</code></td></tr>
                                        <tr><th>PHP Version</th><td><code class="badge badge-info">{$this->details->phpVersion} <a href="{$this->details->currentURL}?phpinfo"><button title="PHPInfo()" type="button" class="btn btn-default glyphicon glyphicon-lock" id="phpInfo">PHPInfo()</button></a></code></td></tr>
                                        <tr><th>ENVIRONMENT</th><td><code>{$this->details->environment}</code></td></tr>
                                        <tr><th>DIR</th><td><code>{$this->details->directory}</code></td></tr>
                                        <tr><th>GIT Branch</th><td><code>{$this->details->gitBranch}</code></td></tr>                                        
                                        <tr><th>CRM URL</th><td><code>{$this->details->crm_url}</code></td></tr>
                                        <tr><th>API URL</th><td><code>{$this->details->api_url}</code></td></tr>
                                        <tr><th>CI DB Hostname</th><td><code>{$this->details->dbHostName}:{$this->details->dbPort}</code></td></tr>
                                        <tr><th>CI DB Username</th><td><code>{$this->details->dbUserName}</code></td></tr>
                                        <tr><th>CI DB Database</th><td><code>{$this->details->dbName}</code>&nbsp;<a href="{$this->details->currentURL}?refreshGrants"><button title="Refresh Grants" type="button" class="btn btn-default glyphicon glyphicon-lock" id="refreshGrants"></button></a>&nbsp;<button title="Refresh Entire Database" type="button" class="btn btn-default glyphicon glyphicon-refresh" id="refreshDatabase" disabled></button>&nbsp;<a href="{$this->details->currentURL}?listTables"><button title="Refresh Table(s)" type="button" class="btn btn-default glyphicon glyphicon-list" id="refreshTable"></button></a></td></tr>
                                        <tr><th>DIR</th><td><code>{$this->details->directory}</code></td></tr>
                                        <tr><th>request()->ip()</th><td><code>{$remoteAddress}</code></td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-bordered table-striped table-hover">
hd1;
            if( $this->details->cronFileExists )
            {
                $response .= <<<hd2
                                        <tr><th> Cron File </th><td class="success"><span class="glyphicon glyphicon-ok"> FOUND</span></td></tr>
                                        <tr><th>CRON DB Hostname</th><td><code>{$this->details->cronDBHostName}</code></td></tr>
                                        <tr><th>CRON DB Username</th><td><code>{$this->details->cronDBUserName}</code></td></tr>
                                        <tr><th>CRON DB Database</th><td><code>{$this->details->cronDBName}</code></td></tr>
                                        <tr><th>CRON DB Port</th><td><code>{$this->details->cronDBPort}</code></td></tr>
                                        <tr><th>CRON Old DB Hostname</th><td><code>{$this->details->cronOldDBHostName}</code></td></tr>
                                        <tr><th>CRON Old DB Username</th><td><code>{$this->details->cronOldDBUserName}</code></td></tr>
                                        <tr><th>CRON Old DB Database</th><td><code>{$this->details->cronOldDBName}</code></td></tr>
                                        <tr><th>CRON Old DB Port</th><td><code>{$this->details->cronOldDBPort}</code></td></tr>
hd2;
            }
            else
            {
                $response .= "\n\t\t\t\t\t\t\t\t\t\t<tr><th> Cron File </th><td class=\"danger\"><span class=\"glyphicon glyphicon-remove\"> NOT INSTALLED</span></td></tr>";
            }
            $response .= <<<hd3
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-reponsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tr><td colspan="7"><p class="h1 text-center">Last 10 Authors/Committers</p></td></tr>
hd3;
            $committersAndAuthorsFormatHeaders = explode( '|', $this->details->committersAndAuthorsFormatHeaders );
            $response .= "<tr>";
            foreach ( $committersAndAuthorsFormatHeaders as $key => $header )
            {
                $response .= "<th>".$header."</th>";
            }
            $response .= "</tr>";
            $t = explode( "\n", $this->details->committersAndAuthors );
            foreach ( $t as $index => $line )
            {
                $response .= "<tr>";
                $a = explode( '|', $line );
                foreach ( $a as $key => $column )
                {
                    $response .= "<td><code>".$column."</code></td>";
                }
                $response .= "</tr>";
            }
            $response .= <<<hd4
                        </table>
                    </div>
                </div>
                <script type="application/javascript">
                //$(document).ready(function() {
                //    $('#refreshGrants').on('click', function(){
                //        $.get( "{$this->details->currentURL}/refreshGrants", function( data ){
                //            alert( "Load was performed. Data = "+data );
                //        });
                //    });
                //});
                </script>
            </body>
        </html>
hd4;
        }

        return response($response);
    }

    public function phpinfo()
    {
        phpinfo();
        exit;
    }

    public function configDetails( $format = 'json' )
    {
        switch( $format )
        {
            case 'json':    $t = $this->details->committersAndAuthors;
                return response()->json($this->details);

                break;
            default:  $this->index();
        }
    }

    public function refreshGrants( $notificationEmail = 'shammi.shailaj@healthians.com' )
    {
        // read the current database name and hostname
        // pass both to the script and report that the execution is going on and that they shall receive an email once the refresh finishes
        // on techteam@healthians.com
        $response = "<pre>";

        $cmd = "/usr/bin/php -f /doctor/trials/refreshGrants.php -- -d \"".$this->details->dbName."\" -h \"".$this->details->dbHostName."\" --grantee-username \"".$this->details->dbUserName."\" -P ".$this->details->dbPort;
        $response .= PHP_EOL.date('c')." SHELLEXEC :: ".$cmd;
        passthru( $cmd );

        $response .= "</pre>";

        return response($response);
    }

    public function listTables()
    {
        $response = $this->htmlHeader; // output HTML header

        $response .= <<<htmlBody
	<body class="bootstarp-code-font">
		<div class="container-fluid text">
			<div class="col-md-10 table-responsive">
				<table class="table table-responsive">
					<tr>
						<td>
							<table class="table table-responsive table-bordered table-striped table-hover">
								<tr><th>Table</th><th>Table Type</th><th>DB Host:Port</th><th>DB Name</th><th>Last Refresh</th><th>Operations</th></tr>
htmlBody;
        // get the list of tables
        $q1 = $this->db->query( 'SELECT `TABLE_NAME`, `TABLE_TYPE`, `CREATE_TIME` FROM `INFORMATION_SCHEMA`.`TABLES` WHERE `TABLE_SCHEMA` = (SELECT DATABASE() FROM DUAL)' );
        $q1NumRows = $q1->num_rows();
        if( $q1NumRows > 0 )
        {
            $r1 = $q1->result_array();
            $response .= '<tr><td colspan="6"> Total tables: '.$q1NumRows.'</td></tr>';
            // start a table
            for( $i = 0; $i < $q1NumRows; $i++ )
            {
                $response .= '<tr><td>'.$r1[$i]['TABLE_NAME'].'</td><td>'.$r1[$i]['TABLE_TYPE'].'</td><td>'.$this->details->dbHostName.':'.$this->details->dbPort.'</td><td>'.$this->details->dbName.'</td><td>'.$r1[$i]['CREATE_TIME'].'</td><td>';
                if( ( time() - strtotime( $r1[$i]['CREATE_TIME']) ) > 86400 )
                {
                    $response .= '<a href="http://sensorium.healthians.co.in/api/v1/dbops/queueRefreshTableJob/'.$r1[$i]['TABLE_NAME'].'/'.$this->details->dbName.'/'.$this->details->dbHostName.'/'.$this->details->dbPort.'"><button title="Enqueue Refresh of Table '.$r1[$i]['TABLE_NAME'].'" type="button" class="btn btn-default glyphicon glyphicon-send" id="refreshTable'.$i.'"></button></a>';
                }
                else
                {
                    $response .= '<button title="Enqueue DISABLED for '.$r1[$i]['TABLE_NAME'].'" type="button" class="btn btn-default glyphicon glyphicon-send" id="refreshTable'.$i.' DISABLED"></button>';
                }

                $response .= '</td></tr>';
            }
        }
        else
            $response .= '<tr><td colspan="5">No tables found </td></tr>';
        $response .= <<<htmlEnd
							</table>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<script type="text/javascript">
		// var totalTables = $q1NumRows;
		// var i = 0;

		// function loadLastRefreshData()
		// {
		// 	var hostName = $('#hp_'+i).html().split(':')[0];
		// 	var dbName = $('#d_'+i).html();
		// 	var tableName = $('#t_'+i).html();

		// 	$.ajax({
		// 		url: 'http://sensorium.healthians.co.in/api/v1/dbops/tableCreationDate/'+hostName+'/'+dbName+'/'+tableName,
		// 		type: 'get',
		// 		cache: false,
		// 		dataType: 'json',
		// 		data: null,
		// 		success: function(responseData, responseStatus, jqXHR){
		// 			$('#lr_'+i).html( responseData[0]['Create_time'] );
		// 			i++;
		// 			if( i < totalTables )
		// 				window.setTimeout( function(){ loadLastRefreshData( i );}, 1000 ); // call self after 1 seconds
		// 		}
		// 	});
		// }
		</script>
	</body>
htmlEnd;

        return response($response);
    }

    public function refreshTables( $tableName = null )
    {
        // @todo Need to write code here to push the table refresh to the db refresh Queue on SQS
        return response('');
    }

    private function view( $filePath, $data )
    {
        extract( $data, EXTR_OVERWRITE );
        include $filePath;
    }

    public function streamFile( $fileID )
    {
        \Log::info(" fileID = ".$fileID.", actual content-type = ".mime_content_type( $this->details->streamingFiles[ $fileID ]['file'] ).', real content-type = '.$this->details->streamingFiles[ $fileID ]['mime'] );
        $this->output->set_content_type( (empty( $this->details->streamingFiles[ $fileID ]['mime'] ) ? mime_content_type( $this->details->streamingFiles[ $fileID ] ) : $this->details->streamingFiles[ $fileID ]['mime'] ) );
        $this->output->set_header( 'Content-Length: '.filesize( $this->details->streamingFiles[ $fileID ]['file'] ) );
        $this->output->set_output( file_get_contents( trim( $this->details->streamingFiles[ $fileID ]['file'] ) ) );
    }

    public function status()
    {
        $this->view( $this->details->streamingFiles[ 0 ], [ 'linuxDashJS' => site_url(strtolower(__CLASS__).'/streamFile/1'), 'linuxDashCSS' => site_url(strtolower(__CLASS__).'/streamFile/2') ] );
    }

    public function statusApi()
    {

        $shell_file = $this->details->streamingFiles[ 3 ]['file'];
        $module = escapeshellcmd( $this->input->get('module') );

        \Log::info(" Module = ".$this->input->get('module') );
        \Log::info(" Shell File = ".$shell_file );

        $cmd = $shell_file . " " . $module;
        \Log::info(" CMD = ".$cmd );
        $response = str_replace("\\", "", shell_exec( $cmd ));

        return response($response)->withHeaders([
            "Cache-Control: no-store, no-cache, must-revalidate",
            "Pragma: no-cache"
        ]);
    }
}
