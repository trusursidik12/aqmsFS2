float temp = 0.0;
float hum = 0.0;
int pinPeltier = 3;
int pinFanPwm = 6;

void setup() {
  Serial.begin(9600);
  pinMode(pinPeltier,OUTPUT);
  pinMode(pinFanPwm,OUTPUT);
  Serial.println("FS2_PSU_START");
  digitalWrite(pinFanPwm, HIGH);
  delay(1000);
  digitalWrite(pinFanPwm, LOW);
  delay(1000);
  digitalWrite(pinFanPwm, HIGH);
  delay(1000);
  digitalWrite(pinPeltier, HIGH);
  delay(1000);
}

void loop() {
  Serial.print("FS2_PSU;");
  Serial.print(temp);
  Serial.print(";");
  Serial.print(hum);
  Serial.println(";");
  delay(1000);
}
