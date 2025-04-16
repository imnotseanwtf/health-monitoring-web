#include <TinyGPSPlus.h>

// Create a TinyGPS++ object
TinyGPSPlus gps;

// Define UART pins for ESP32 (using UART2)
#define RX_PIN 16  // Connect to NEO-6M TX
#define TX_PIN 17  // Connect to NEO-6M RX
#define GPS_BAUD 9600  // Default baud rate for NEO-6M

// Initialize UART2 for GPS communication
HardwareSerial gpsSerial(2);

void setup() {
  // Start the Serial Monitor for debugging
  Serial.begin(9600);
  
  // Start UART2 for GPS module
  gpsSerial.begin(GPS_BAUD, SERIAL_8N1, RX_PIN, TX_PIN);
  
  Serial.println("ESP32 with NEO-6M GPS Module - Starting...");
}

void loop() {
  // Check if data is available from the GPS module
  while (gpsSerial.available() > 0) {
    if (gps.encode(gpsSerial.read())) {
      // Display GPS data when a new sentence is parsed
      displayGPSInfo();
    }
  }

  // If no data is received after 5 seconds, print a warning
  if (millis() > 5000 && gps.charsProcessed() < 10) {
    Serial.println("No GPS data received. Check wiring or satellite signal.");
    delay(1000);
  }
}

void displayGPSInfo() {
  // Check if location data is valid
  if (gps.location.isValid()) {
    Serial.print("Latitude: ");
    Serial.println(gps.location.lat(), 6);
    Serial.print("Longitude: ");
    Serial.println(gps.location.lng(), 6);
    Serial.print("Altitude: ");
    Serial.println(gps.altitude.meters());
  } else {
    Serial.println("Location: INVALID");
  }

  // Check if speed is valid
  if (gps.speed.isValid()) {
    Serial.print("Speed: ");
    Serial.print(gps.speed.kmph());
    Serial.println(" km/h");
  }

  // Check if date and time are valid
  if (gps.date.isValid() && gps.time.isValid()) {
    Serial.print("Date: ");
    Serial.print(gps.date.year());
    Serial.print("-");
    Serial.print(gps.date.month());
    Serial.print("-");
    Serial.println(gps.date.day());
    Serial.print("Time: ");
    Serial.print(gps.time.hour());
    Serial.print(":");
    Serial.print(gps.time.minute());
    Serial.print(":");
    Serial.println(gps.time.second());
  }

  Serial.println("-------------------");
  delay(1000);  // Delay to avoid flooding the Serial Monitor
}