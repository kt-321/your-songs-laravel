<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Google_Client;

use Google_Service_YouTube;

class YouTubeController extends Controller
{

/**
 * Library Requirements
 *
 * 1. Install composer (https://getcomposer.org)
 * 2. On the command line, change to this directory (api-samples/php)
 * 3. Require the google/apiclient library
 *    $ composer require google/apiclient:~2.0
 */
 
    public function index(){
        $results = "";
        $videos = [];
        $keyword = "";
        
        // This code will execute if the user entered a search query in the form
        // and submitted the form. Otherwise, the page displays the form above.
        if (isset($_GET["q"]) && isset($_GET["maxResults"])) {
          /*
           * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
           * Google API Console <https://console.developers.google.com/>
           * Please ensure that you have enabled the YouTube Data API for your project.
           */
          $DEVELOPER_KEY = "AIzaSyA31NmR0sghv6IiW3mxwjcOdhsdyEqI_y8";
        
          $client = new Google_Client();
          $client->setDeveloperKey($DEVELOPER_KEY);
        
          // Define an object that will be used to make all API requests.
          $youtube = new Google_Service_YouTube($client);
        
        $keyword = $_GET["q"];
        
          try {
        
            // Call the search.list method to retrieve results matching the specified
            // query term.
            $searchResponse = $youtube->search->listSearch("id,snippet", array(
              "q" => $_GET["q"],
              "maxResults" => $_GET["maxResults"],
            ));
            
            $results = $searchResponse["items"];
            
            foreach($results as $item){
              if($item->getId()->kind === "youtube#video"){
                $videos[] = $item;
              }
            }
        
          } catch (Google_Service_Exception $e) {
            return "A service error occurred";
          } catch (Google_Exception $e) {
            return "An client error occurred";
          }
        }
        
        // dd($results);
        
        return view ("youtube.index", [
            "videos" => $videos,
            "keyword" => $keyword,
        ]);
    } 
}
