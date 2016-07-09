<?php

/*
 * Version # is used to ensure JS and CSS files are refreshed in user browsers on production release.
 *    CSS and JS files are appended with version # ie
 *    view.css -> 'view.css?v='.RELEASE_VERSION
 * 
 * RELEASE_VERSION number must be updated each time new css and js files are released to production 
 */
const RELEASE_VERSION           = '?v=1';

/*
 * Email Address
 */
const EMAIL_CUSTOMER_SERVICE    = 'customerservice@wtf.ind.in';

/*
 * URL
 */
const WTF_URL              = 'http://www.wtf.ind.in/';


/*
 * Session Variable Identifier constants
 */
const SESS_ADMIN_ID             = 'SESS_ADMIN_ID';
const SESS_ADMIN_NAME           = 'SESS_ADMIN_NAME';
const SESS_LOGIN_ID             = 'LOGIN_ID'; //id of logged in user
const SESS_LOGIN_NAME           = 'LOGIN_NAME'; //username
const SESS_LOGIN_MSG            = 'LOGIN_MSG';
const SESS_ACCESS_LEVEL         = 'SESS_ACCESS_LEVEL';
const SESS_MEMBERSHIP_NAME      = 'SESS_MEMBERSHIP_NAME';


define("LOGON_MESSAGE",             "logon_message");
define("userId",                    "userId");
define("NONE",                      "NONE");
define("VIEW",                      "VIEW");
define("EDIT",                      "EDIT");
define("LOGIN_ID",                  "loginId");
define("FIRST_NAME",                "first_name");
define("LAST_NAME",                 "last_name");
define("SUBMITTED_SCREEN_ACCESS",   "submitted_screen_access");
define("PENDING_SCREEN_ACCESS",     "pending_screen_access");

/*
 * Table registration.status ENUM values
 */
const REGISTRATION_NEW                  = 'new';
const REGISTRATION_APPROVED             = 'approved';
const REGISTRATION_REJECTED             = 'rejected';

?>
