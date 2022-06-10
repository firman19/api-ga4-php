# API for Google Analytic 4 using PHP  

### Steps
1. Enable API and create service account in https://console.cloud.google.com/  
2. Add service account to GA 4 property  
3. Download credential and set environment variable, example:  
``` export GOOGLE_APPLICATION_CREDENTIALS="/home/user/Downloads/credentials.json" ```
4. Run ```composer install```  
5. Set your property ID  
6. Run ```php analytics.php```  