#include <ESP8266WiFi.h>
#include <WiFiUdp.h>
#include <NTPClient.h>

#include "SPI.h"
#include "Wire.h"
#include "Adafruit_GFX.h"
#include "Adafruit_SSD1306.h"
#include <ESP8266HTTPClient.h>

int Test = 1;
const char *ssid     = "YOUR-SSID";
const char *password = "YOUR-PASSWORD";

#define OLED_RESET 0  // GPIO0
Adafruit_SSD1306 display(OLED_RESET);

WiFiUDP ntpUDP;

// Change this depending on your location
NTPClient timeClient(ntpUDP, "2.uk.pool.ntp.org", 3600, 60000);
String Day = "Sun";
String Dose = "0mg";

void calculateDay() {
  // Subroutine to convert the Day
    Serial.print("Today is day: ");
    Serial.println(timeClient.getDay());
    if (timeClient.getDay() == 0) {
    Day = "Wed";
    }
    else if (timeClient.getDay() == 1) {
      Day = "Thu";
      }
    else if (timeClient.getDay() == 2) {
      Day = "Fri";
      }
    else if (timeClient.getDay() == 3) {
      Day = "Sat";
      } 
    else if (timeClient.getDay() == 4) {
      Day = "Sun";
      }
    else if (timeClient.getDay() == 5) {
      Day = "Mon";
      }
    else if (timeClient.getDay() == 6) {
      Day = "Tue";
      } else {
    Serial.println("Error calculating day!");
    display.println("Error!");      
    }
}

void fetchDose() {
 // Fetch the amount of warferin from a webpage.   
    HTTPClient http;

    Serial.print("[HTTP] begin...\n");
    // configure the URL where we can pull the dosage from. Might
    // Also, if you don't want anyone to see it, it's a good idea to
    // create a long, random webpage name.
    http.begin("YOUR URL TO THE DOSE SCRIPT"); //HTTP

    Serial.print("[HTTP] GET...\n");
    // start connection and send HTTP header
    int httpCode = http.GET();
  // httpCode will be negative on error
  if (httpCode > 0) {
    // HTTP header has been send and Server response header has been handled
    Serial.printf("[HTTP] GET... code: %d\n", httpCode);
    // file found at server
    if (httpCode == HTTP_CODE_OK) {
      Dose = http.getString();
      Serial.println("Dosage updated!");
      Serial.println(Dose);
      
      
    }
  } else {
    Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
  }
}
  
void setup(){
  Serial.begin(115200);

  WiFi.begin(ssid, password);

  while ( WiFi.status() != WL_CONNECTED ) {
    delay ( 1000 );
    Serial.print ( "." );
  }
  timeClient.begin();
  display.begin(SSD1306_SWITCHCAPVCC, 0x3C); 
  // init done

  display.clearDisplay();
  display.setTextSize(2);
  display.setTextColor(WHITE);
  display.setCursor(13,0);
  calculateDay();
  fetchDose();
  display.setTextSize(1);
  display.setCursor(7,40);
  display.println(timeClient.getFormattedTime());
  display.display();
  //Serial.println(dose);
  delay(1000);
}

void loop() {
  timeClient.update();
if (timeClient.getFormattedTime() == "00:00:00") {
  display.clearDisplay();
  display.setTextSize(2);
  display.setTextColor(WHITE);
  display.setCursor(13,0);
  calculateDay();
  fetchDose();
  display.setTextSize(1);
  display.setCursor(7,40);
  display.println(timeClient.getFormattedTime());
  display.display();
  
 } else {  
  display.clearDisplay();
  display.setTextSize(2);
  display.setTextColor(WHITE);
  display.setCursor(14,0);
  display.println(Day);
  display.setCursor(14,20);
  display.println(Dose);
  display.setTextSize(1);
  display.setCursor(7,40);
  display.println(timeClient.getFormattedTime());
  display.display();
 }
  delay(1000);
}
