THIRRA

THIRRA which is the acronym for Portable System for *T*elehealth and *H*ealth *I*nformatics in *R*ural & *R*emote *A*reas is an Electronic Health Records System for ambulatory care. THIRRA is built upon the excellent CodeIgniter PHP framework. For convenience, the framework is bundled with the source codes for THIRRA.



Requires:
Code Igniter version 2.1.0
PostgreSQL version 8.x
PHP v5.x
Netpbm
mpdf version 5.2

Setup Guide:
1. Download tarball from Sourceforge.net or pull down from Subversion SCM repository
2. Download sample database from Sourceforge.net
3. Extract tarball into temporary directory, which will contain a directory called 'thirra'.
4. For svn pull down, use 'thirra' directory inside trunk.
5. Move 'thirra' directory into Apache Docroot directory
6. Change ownership of 'thirra' directory recursively to Apache user
7. Restore sample database into PostgreSQL using parameters stated inside thirra/application/config/database.php
8. Change the following variable inside thirra/application/config/config.php accordingly:

    $config['app_folder'] = 'thirra'; // Change to suit installation
    $config['debug_mode'] = FALSE; // Set TRUE to turn on debugging
    $config['offline_mode'] = FALSE; // Set TRUE for mobile servers

9. Extract and rename mpdf directory to [doc_root]/mpdf
10. Make symbolic link thirra/mpdf to [doc_root]/mpdf
11. Create other empty directories for files storage by copying from <app_folder>/uploads to <app_folder>-uploads
12. Access login page using browser

    http://<server_name>/<app_folder>

Application includes a temp bug fix to postgreSQL driver for Code Igniter still not resolved in v1.7.2.

The sample database thirra-samp-xx.backup contains some dummy data. Use user=demo pwd=demo123 to log in.

For enquiries, you can contact Jason Tan Boon Teck (tanboonteck@gmail.com)

