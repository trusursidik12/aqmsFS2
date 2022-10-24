int ntcpin = A0;
int flowpin = A1;
int pwmpin = 11;
int heaterpin = 12;
int adjpin = A2;
int pumpspeed = 60;
int sccm = 0;
int adj = 0;
int ntc = 0;
int ntcmax = 800;
int ntcmin = 700;
int heaterstate = LOW;

void setup() {
  Serial.begin(9600);
  pinMode(pwmpin, OUTPUT);
  pinMode(heaterpin, OUTPUT);
  digitalWrite(heaterpin, HIGH);
  delay(1000);
  digitalWrite(heaterpin, LOW);
}

void loop() {
    //Pump
    sccm = map(analogRead(flowpin),0,1023,0,3000);
    adj = map(analogRead(adjpin),0,1023,-512,512);
    sccm = sccm + adj;
    Serial.println("Adj \t\t= " + String(adj)); 
    Serial.println("Pumpspeed \t= " + String(pumpspeed));
    Serial.println("Sccm \t\t= " + String(sccm));
    if (sccm < 1990){
      pumpspeed++;
    }
    if (sccm > 2010){
      pumpspeed --;
    }
    analogWrite(pwmpin, map(pumpspeed,0,100,0,255));




    //heater
    ntc = analogRead(ntcpin);
    if (ntc > ntcmax){
      heaterstate = LOW;
    }
    if (ntc < ntcmin){
      heaterstate = HIGH;
    }
    Serial.println("ntc \t\t= " + String(ntc));
    Serial.println("Heaterstate \t= " + String(heaterstate));
    digitalWrite(heaterpin, heaterstate);
    Serial.println("");
    




  /*
  //if (Serial.available() > 0) {
  //pumpspeed = Serial.readString().toInt();
  pumpspeed = map(analogRead(ntcpin),0,1024,0,512);
  Serial.print(map(pumpspeed,0,511,0,100));
  Serial.print(":");
  Serial.print(pumpspeed);
  Serial.print(":");
  Serial.println(analogRead(ntcpin));
  analogWrite(pwmpin, pumpspeed);
  //}
  */
  delay(1000);
}
