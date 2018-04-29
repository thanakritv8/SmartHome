// Include
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <DNSServer.h>
#include <ESP8266WebServer.h>
#include <WiFiManager.h>

// Variable
#define D0 16             // USER LED Wake
#define ledPin  D0        // the number of the LED pin
#define D1 5
#define ConfigWiFi_Pin D1 
#define ESP_AP_NAME "SmartHome Config AP"
String id = "2";
String Url = "http://profiledev.xyz/SmartHome/Box/index.php?id=" + id;

void setup ()
{
  pinMode(ledPin, OUTPUT);
  pinMode(ConfigWiFi_Pin,INPUT_PULLUP);
  Serial.begin(115200);
  digitalWrite(ledPin,HIGH);
  WiFiManager wifiManager;
  //wifiManager.resetSettings();  //Use Test
  if(digitalRead(ConfigWiFi_Pin) == LOW) // Press button
  {
    //reset saved settings
    wifiManager.resetSettings(); // go to ip 192.168.4.1 to config
  }
  wifiManager.autoConnect(ESP_AP_NAME); 
  while (WiFi.status() != WL_CONNECTED){
     delay(250);
     Serial.print(".");
  }
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}
 
void loop(){
  if (WiFi.status() == WL_CONNECTED){
    digitalWrite(ledPin,LOW);  // Show Connected
    HTTPClient http; //Declare an object of class HTTPClient
    http.begin(Url); //Specify request destination
    int httpCode = http.GET(); //Send the request
    if (httpCode > 0)
    { //Check the returning code
      String payload = http.getString(); //Get the request response payload
      Serial.println("Round"); //Print the response payload
      String Device1 = payload.substring(0, 1);
      Serial.println("Device1 = " + Device1);
      String Device2 = payload.substring(2, 3);
      Serial.println("Device2 = " + Device2);
      String Device3 = payload.substring(4, 5);
      Serial.println("Device3 = " + Device3);
      if ((Device1 == "1" || Device1 == "0") && (Device2 == "1" || Device2 == "0") && (Device3 == "1" || Device3 == "0")){
        // Content
      }else{
        digitalWrite(ledPin,LOW);
        delay(250);
        digitalWrite(ledPin,HIGH);
        delay(250);
      }
    }
    http.end(); //Close connection
  }else{
    digitalWrite(ledPin,HIGH); // Can't connect
  }
  delay(500);
}
