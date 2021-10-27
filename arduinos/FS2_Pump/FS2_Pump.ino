int speedpump = map(50,0,100,0,255);
int pressure = 0;
float temp = 0.0;
float hum = 0.0;
int pinPump1 = 6;
int pinPump2 = 3;
int pinFanPwm = 9;
int pinPressure = A0;
int activePin = pinPump2;

void setup() {
  Serial.begin(9600);
  pinMode(pinPump1,OUTPUT);
  pinMode(pinPump2,OUTPUT);
  pinMode(pinFanPwm,OUTPUT);
  Serial.println("FS2_PUMP_START");
  digitalWrite(pinFanPwm, HIGH);
  delay(1000);
  digitalWrite(pinFanPwm, LOW);
  delay(1000);
  digitalWrite(pinFanPwm, HIGH);
  delay(1000);
}

void loop() {
  pressure = analogRead(pinPressure);
  if (Serial.available() > 0) {
    analogWrite(pinPump1,0);
    analogWrite(pinPump2,0);
    speedpump = Serial.readString().toInt();
    if(speedpump > 100){
      speedpump = map(speedpump,101,200,0,255);
      activePin=pinPump1;
    }else {
      speedpump = map(speedpump,0,100,0,255);
      activePin=pinPump2;
    }
  }
  analogWrite(activePin,speedpump);
  Serial.print("FS2_PUMP;");
  Serial.print(activePin);
  Serial.print(";");
  Serial.print(speedpump);
  Serial.print(";");
  Serial.print(pressure);
  Serial.print(";");
  Serial.print(temp);
  Serial.print(";");
  Serial.print(hum);
  Serial.println(";");
  delay(1000);
}
