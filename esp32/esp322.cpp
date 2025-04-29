#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>
#include <PulseSensorPlayground.h>

// Wi-Fi Configuration
const char* ssid = "YOUR_WIFI_NAME";
const char* password = "YOUR_WIFI_PASSWORD";

// API Configuration 
const char* server = "YOUR_SERVER_IP";
const String apiUrl = "http://" + String(server) + "/api/sensor";

// Device Identifier
const char* deviceId = "esp32-01";

// Pulse Sensor Configuration
const int PULSE_SENSOR_PIN = 34;  // Use ADC1 channel (GPIO36 - VP)
const int THRESHOLD = 2000;       // Adjust based on your sensor's signal

// Pulse Sensor Object
PulseSensorPlayground pulseSensor;
unsigned long lastBeatTime = 0;
int bpm = 0;

// Network
unsigned long lastUpload = 0;
const unsigned long uploadInterval = 10000; // 10 seconds

void connectToWiFi() {
  WiFi.begin(ssid, password);
  Serial.print("Connecting to WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConnected: " + WiFi.localIP().toString());
}

void setup() {
  Serial.begin(9600);
  delay(1000);

  // Configure pulse sensor
  pulseSensor.analogInput(PULSE_SENSOR_PIN);
  pulseSensor.setThreshold(THRESHOLD);
  
  if (!pulseSensor.begin()) {
    Serial.println("Pulse sensor initialization failed!");
    while (1);
  }

  connectToWiFi();
}

void loop() {
  // Update pulse sensor values
  int rawValue = analogRead(PULSE_SENSOR_PIN);
  
  if (pulseSensor.sawStartOfBeat()) {
    bpm = pulseSensor.getBeatsPerMinute();
    lastBeatTime = millis();
    Serial.print("♥ Heartbeat detected! BPM: ");
    Serial.println(bpm);
  }

  // Handle WiFi reconnection
  if (WiFi.status() != WL_CONNECTED) {
    connectToWiFi();
  }

  // Send data periodically
  if (millis() - lastUpload >= uploadInterval && bpm > 0) {
    sendBpmToServer();
    lastUpload = millis();
  }

  // Optional: Add sensor data visualization
  Serial.println(rawValue);  // For Serial Plotter visualization
  Serial.println(bpm);  // For Serial Plotter visualization
  delay(100); // Short delay for stability
}

void sendBpmToServer() {
  if (bpm < 30 || bpm > 200) return; // Filter unrealistic values

  HTTPClient http;
  http.begin(apiUrl);
  http.addHeader("Content-Type", "application/json");

  DynamicJsonDocument doc(128);
  doc["bpm"] = bpm;
  doc["device_identifier"] = deviceId;

  String payload;
  serializeJson(doc, payload);

  int httpCode = http.POST(payload);
  
  if (httpCode == HTTP_CODE_CREATED || httpCode == HTTP_CODE_OK) {
    Serial.println("Data sent successfully");
    Serial.printf("Response code: %d\n", httpCode);
  } else {
    Serial.printf("HTTP error: %d\n", httpCode);
    Serial.println("Failed to send data");
  }
  
  http.end();
}