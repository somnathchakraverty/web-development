<?php
namespace App\Http\Controllers\Server;

Trait Config
{
    public $baseURL;
    public $siteURL;
    public $serverHostName;
    public $phpVersion;
    public $environment;
    public $directory = __DIR__;
    public $gitBranch;
    public $committersAndAuthorsFormat = '"%H | %an &lt;%ae&gt; | %ad | %ar | %cd | %cr | %cn &lt;%ce&gt;"';
    public $committersAndAuthorsFormatHeaders = "Commit Hash | Author Name &lt;Author Email&gt; | Author Date | Author Date, Relative | Committer Date | Committer Date, Relative | Committer Name &lt;Committer Email&gt;";
    public $committersAndAuthors;
    public $dbHostName;
    public $dbUserName;
    public $dbPassword;
    public $dbName;
    public $dbPort;
    public $cronFileExists = FALSE;
    public $cronDBHostName;
    public $cronDBUserName;
    public $cronDBPassword;
    public $cronDBName;
    public $cronDBPort;
    public $cronOldDBHostName;
    public $cronOldDBUserName;
    public $cronOldDBPassword;
    public $cronOldDBName;
    public $cronOldDBPort;
    public $cmd = "git branch | grep \\* | awk '{print $2}'";
    public $output;
    public $outputRetVal;
    public $streamingFiles;

    public $htmlHeader;
}