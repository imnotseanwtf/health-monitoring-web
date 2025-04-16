#define SENSOR_PIN 14    // GPIO 14 (ADC2_CH6)
#define SAMPLE_RATE 100  // Sampling rate in milliseconds (100 ms = 10 Hz)
#define THRESHOLD 1875   // Adjusted threshold based on your data

int lastValue = 0;       // Previous sensor reading
unsigned long lastBeat = 0;  // Time of the last detected beat (in milliseconds)
int bpm = 0;             // Calculated beats per minute

void setup() {
  Serial.begin(9600);    // Start serial communication at 9600 baud
  delay(1000);           // Small delay to stabilize
  Serial.println("Starting pulse monitor...");  // This will show in Serial Monitor, not Plotter
}

void loop() {
  // Read the sensor value
  int sensorValue = analogRead(SENSOR_PIN);

  // Detect a beat (rising edge crossing the threshold)
  if (sensorValue > THRESHOLD && lastValue <= THRESHOLD) {
    unsigned long currentTime = millis();  // Get current time
    unsigned long timeBetweenBeats = currentTime - lastBeat;  // Time since last beat

    // Calculate BPM (60,000 ms = 1 minute)
    if (timeBetweenBeats > 300 && timeBetweenBeats < 2000) {  // Filter unrealistic intervals
      bpm = 60000 / timeBetweenBeats;  // Convert interval to BPM
    }
    lastBeat = currentTime;  // Update the last beat time
  }

  // Output for Serial Plotter: sensorValue and bpm (tab-separated)
  Serial.print(sensorValue);  // First value: raw sensor reading
  Serial.print("\t");         // Tab separator
  Serial.println(bpm);        // Second value: BPM (0 when no beat detected)

  // Update the last value for the next comparison
  lastValue = sensorValue;

  delay(SAMPLE_RATE);  // Control sampling rate
}