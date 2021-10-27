String string_pm01 = "";
String string_pm02 = "";

int pinFanPwm = 8;
int pinVacuum = A1;
int vacuum = 0;
float temp1 = 0.0;
float temp2 = 0.0;
float hum1 = 0.0;
float hum2 = 0.0;

void setup() {
    Serial.begin(9600);
    Serial1.begin(9600);
    Serial2.begin(9600);
    pinMode(pinFanPwm, OUTPUT);
    delay(1000);
    digitalWrite(pinFanPwm, HIGH);
    delay(1000);
    digitalWrite(pinFanPwm, LOW);
    delay(1000);
    digitalWrite(pinFanPwm, HIGH);
}

String getValue(String data)
{
    String retval = "";
    String temp = "";
    if(data.length() > 0){
      temp += data[0];
      temp += data[1];
      temp += data[2];
      temp += data[3];
      if(temp == "000."){
        int comas = 0;
        for(int i=0;i<data.length() - 1;i++){
          if(comas < 2 && data[i] != ','){
            retval += data[i];
          } else {
            if(comas < 1) retval += ";";
            comas++;
          }
        }
      } else {
        retval = "000.000;0.0";
      }
    }
    return retval;
}

void loop() {
  vacuum = analogRead(pinVacuum);
  if(Serial1.available() > 0){
    string_pm01 = "";
    while(Serial1.available() > 0){
      char pm01_read = Serial1.read();
      if(pm01_read != 13 && pm01_read != 10){string_pm01 += pm01_read;}
    }
  }
  
  if(Serial2.available() > 0){
    string_pm02 = "";
    while(Serial2.available() > 0){
      char pm02_read = Serial2.read();
      if(pm02_read != 13 && pm02_read != 10){string_pm02 += pm02_read;}
    }
  }
  
  Serial.println("FS2_ANALYZER;" + getValue(string_pm01) + ";" + getValue(string_pm02) + ";" + vacuum + ";" + temp1 + ";" + hum1 + ";" + temp2 + ";" + hum2 + ";");
  delay(1000);
}
