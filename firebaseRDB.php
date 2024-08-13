<?php
/*
 * Class Name: firebaseRDB
 * Version: 1.1
 * Author: Devisty (Modified)
 */

class firebaseRDB {
   private $url;

   function __construct($url = null) {
      if (isset($url)) {
         $this->url = rtrim($url, '/');
      } else {
         throw new Exception("Database URL must be specified");
      }
   }

   private function grab($url, $method, $par = null) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      if (isset($par)) {
         curl_setopt($ch, CURLOPT_POSTFIELDS, $par);
      }
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 120);
      curl_setopt($ch, CURLOPT_HEADER, 0);

      $response = curl_exec($ch);

      if ($response === false) {
         throw new Exception('cURL error: ' . curl_error($ch));
      }

      curl_close($ch);

      return $response;
   }

   public function insert($table, $data) {
      $path = "{$this->url}/$table.json";
      return $this->grab($path, "POST", json_encode($data));
   }

   public function update($table, $uniqueID, $data) {
      $path = "{$this->url}/$table/$uniqueID.json";
      return $this->grab($path, "PATCH", json_encode($data));
   }

   public function delete($table, $uniqueID) {
      $path = "{$this->url}/$table/$uniqueID.json";
      return $this->grab($path, "DELETE");
   }

   public function retrieve($dbPath, $queryKey = null, $queryType = null, $queryVal = null) {
      $dbPath = rtrim($dbPath, '/');
      $pars = "";

      if (isset($queryType) && isset($queryKey) && isset($queryVal)) {
         $queryVal = urlencode($queryVal);

         if ($queryType == "EQUAL") {
            $pars = "orderBy=\"$queryKey\"&equalTo=\"$queryVal\"";
         } elseif ($queryType == "LIKE") {
            $pars = "orderBy=\"$queryKey\"&startAt=\"$queryVal\"";
         }
      }

      $pars = $pars ? "?$pars" : "";
      $path = "{$this->url}/$dbPath.json$pars";

      return $this->grab($path, "GET");
   }
}
