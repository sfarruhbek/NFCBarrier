#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <ArduinoJson.h>
//#include <Servo.h>

//const int SP = D1;
//Servo Srv;

#define RST_PIN D3
#define SS_PIN D8

const char* ssid = "with TEST";
const char* password = "12345678.";

MFRC522 mfrc522(SS_PIN, RST_PIN);
ESP8266WebServer server(80);

String tagId = "";

void setup() {
  Serial.begin(115200);
  SPI.begin();
  mfrc522.PCD_Init();

  //Srv.attach(SP);

  // WiFi Hotspotini yoqish
  WiFi.softAP(ssid, password);
  Serial.println("Hotspot yoqildi");
  Serial.print("IP manzili: ");
  Serial.println(WiFi.softAPIP());

  server.on("/read", handleTagRead);
  server.on("/open", handleOpen);
  server.on("/close", handleClose);
  server.begin();
  Serial.println("HTTP serveri yoqildi");
}

void loop() {
  server.handleClient();
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    tagId = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      char hex[4];
      sprintf(hex, "%02X", mfrc522.uid.uidByte[i]);
      tagId += String(hex);
    }
    Serial.println("Tag ID: " + tagId);

    mfrc522.PICC_HaltA();
  }

  delay(50);
}

void handleTagRead() {
  StaticJsonDocument<200> doc;
  if (tagId.length() > 0) {
    doc["status"] = 1;
    doc["id"] = tagId;
    String jsonString;
    serializeJson(doc, jsonString);
    server.sendHeader("Access-Control-Allow-Origin", "*");
    server.send(200, "application/json", jsonString);
    tagId = "";
  } else {
    doc["status"] = 0;
    doc["id"] = "0";
    String jsonString;
    serializeJson(doc, jsonString);
    server.sendHeader("Access-Control-Allow-Origin", "*");
    server.send(200, "application/json", jsonString);
  }
}

void handleOpen() {
  //Srv.write(180);
  Serial.println("Open");
  server.sendHeader("Access-Control-Allow-Origin", "*");
  server.send(200, "text/plain", "OK");
}

void handleClose() {
  //Srv.write(0);
  Serial.println("Close");
  server.sendHeader("Access-Control-Allow-Origin", "*");
  server.send(200, "text/plain", "OK");
}
