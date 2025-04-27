#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

// Wi-Fi Configuration
const String ssid = "YOUR WIFI NAME";
const String password = "YOUR WIFI PASSWORD";

// API Configuration
const String ipAddress = "IP_ADDRESS";
const String apiUrl = "http://" + ipAddress + "/api";

// ESP32 Identifier
char* deviceIdentifier = "esp32-01";

// Pulse Sensor Configuration
#define SENSOR_PIN 34    // GPIO 14 (ADC2_CH6)
#define SAMPLE_RATE 100  // Sampling rate in milliseconds (100 ms = 10 Hz)
#define THRESHOLD 1000   // Lowered threshold to detect pulses
const int highBpmThreshold = 100;  // Threshold for immediate data sending
const unsigned long normalInterval = 10000;  // Normal data sending interval (10s)

// Pulse Variables
int lastValue = 0;       // Previous sensor reading
unsigned long lastBeat = 0;  // Time of the last detected beat (in milliseconds)
int bpm = 0;             // Calculated beats per minute
unsigned long lastDataSent = 0;  // Time of the last data sent

void setup() {
  Serial.begin(9600);    // Start serial communication at 9600 baud
  delay(1000);           // Small delay to stabilize
  Serial.println("Starting pulse monitor...");  // This will show in Serial Monitor, not Plotter

  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  Serial.print("Connecting to Wi-Fi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConnected to Wi-Fi");

  delay(5000);  // Delay to stabilize connection
}

void loop() {
  // Read the sensor value
  int sensorValue = analogRead(SENSOR_PIN);

  // Debug: Print sensor value to check range
  Serial.print("Sensor: ");
  Serial.print(sensorValue);
  Serial.print(" | Threshold: ");
  Serial.println(THRESHOLD);

  // Detect a beat (rising edge crossing the threshold)
  if (sensorValue > THRESHOLD && lastValue <= THRESHOLD) {
    unsigned long currentTime = millis();  // Get current time
    unsigned long timeBetweenBeats = currentTime - lastBeat;  // Time since last beat

    // Calculate BPM (60,000 ms = 1 minute)
    if (timeBetweenBeats > 300 && timeBetweenBeats < 2000) {  // Filter unrealistic intervals
      bpm = 60000 / timeBetweenBeats;  // Convert interval to BPM
      Serial.print("Beat detected, BPM: ");
      Serial.println(bpm);
    }
    lastBeat = currentTime;  // Update the last beat time
  }

  // Array to store last 10 BPM values
  static int lastBpmValues[10] = {0};
  static int bpmIndex = 0;

  // Store current BPM value
  lastBpmValues[bpmIndex] = bpm;
  bpmIndex = (bpmIndex + 1) % 10;

  // Check if all last 10 values are above threshold
  bool allHigh = true;
  for (int i = 0; i < 10; i++) {
    if (lastBpmValues[i] <= highBpmThreshold || lastBpmValues[i] == 0) {
      allHigh = false;
      break;
    }
  }

  if (allHigh) {
    Serial.println("Consistently high BPM detected - Sending immediately.");
    storedSensorsValue(bpm, deviceIdentifier);
    lastDataSent = millis();
  }
  
  // Send data at normal interval if due
  if (millis() - lastDataSent >= normalInterval && bpm > 0) {
    Serial.print("Normal interval sending. Last valid BPM: ");
    Serial.println(bpm);
    storedSensorsValue(bpm, deviceIdentifier);
    lastDataSent = millis();
  }

  // Output for Serial Plotter: sensorValue and bpm (tab-separated)
  Serial.print(sensorValue);  // First value: raw sensor reading
  Serial.print("\t");         // Tab separator
  Serial.println(bpm);        // Second value: BPM (0 when no beat detected)

  // Update the last value for the next comparison
  lastValue = sensorValue;

  delay(SAMPLE_RATE);  // Control sampling rate
}

void storedSensorsValue(int bpmValue, char* deviceIdentifierValue) {
  const String storeSensorValue = apiUrl + "/sensor";

  HTTPClient http;
  http.begin(storeSensorValue);
  http.addHeader("Content-Type", "application/json");

  // Create a JSON object
  StaticJsonDocument<200> doc;                               // 200 is the capacity in bytes, adjust if needed
  doc["bpm"] = (int)bpmValue;                                // Force to integer if bpm is float or another type
  doc["device_identifier"] = String(deviceIdentifierValue);  // Force to String if needed

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