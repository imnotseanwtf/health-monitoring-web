#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

const String ssid = "YOUR_WIFI_SSID";
const String password = "YOUR_WIFI_PASSWORD";
const String ipAddress = "YOUR_IP_ADDRESS";

// API 
const String storeSensorValue = "http://" + ipAddress + "/api/sensor";

void setup() {
  Serial.begin(9600);

  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  Serial.print("Connecting to Wi-Fi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nConnected to Wi-Fi");
}

void loop() {
  delay(5000);
  storedSensorsValue();
}

void storedSensorsValue() {
  HTTPClient http;
  http.begin(pulseResourceUrl);
  http.addHeader("Content-Type", "application/json");

  // Create a JSON object
  StaticJsonDocument<200> doc; // 200 is the capacity in bytes, adjust if needed
  doc["bpm"] = "75"; // Replace with your sensor data (string or number)

  // Serialize JSON to a string
  String jsonPayload;
  serializeJson(doc, jsonPayload);

  // Send the POST request
  int httpCode = http.POST(jsonPayload);

  if (httpCode > 0) {
    String payload = http.getString();
    Serial.println("Response Code: " + String(httpCode));
    Serial.println("Response: " + payload);
  } else {
    Serial.println("Error on HTTP request: " + String(httpCode));
  }
  http.end();
}