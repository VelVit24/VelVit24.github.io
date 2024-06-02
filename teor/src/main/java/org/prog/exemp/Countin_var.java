package org.prog.exemp;
import java.text.DecimalFormat;
import java.util.Random;
import org.prog.functions.Funct;

public class Countin_var {
    int []x1 = new int[7];
    int []x2 = new int[2];
    double x3;
    int x4, x5;
    public Countin_var() {
        Random rn = new Random();
        x1[0] = rn.nextInt(7)+1;
        x1[1] = rn.nextInt(6)+2;
        x1[2] = rn.nextInt(4)+1;
        x1[3] = rn.nextInt(5)+1;
        x1[4] = rn.nextInt(5)+x1[3]+2;
        x1[5] = rn.nextInt(5)-5;
        x1[6] = rn.nextInt(4)+x1[5]+2;

        x2[0] = rn.nextInt(6)+1;
        x2[1] = rn.nextInt(4)+2;

        x3 = (rn.nextInt(8)+1)/1000.0;
        x4 = rn.nextInt(100)+150;
        x5 = rn.nextInt(3)+2;
    }
    public String[] getText() {
        String[] s = new String[7];
        s[0] = "16. Дана плотность вероятности f(x) непрерывной случайной величины X. Требуется: ";
        s[1] = "1) найти параметр a;";
        s[2] = "2) найти функцию распределения F(x);";
        s[3] = "3) построить графики f(x) и F(x);";
        s[4] = "4) найти асимметрию и эксцесс X.";
        s[5] = "f(x) = { 0, x<="+x2[0]+";";
        s[6] = "          { a/x^"+x2[1]+", x>"+x2[0]+";";
        return s;
    }
    public String[] getAns() {
        DecimalFormat df = new DecimalFormat("0.000");
        String[] s = new String[1];
        s[0] = "16. a) " + ((int)Funct.countinInterg(x2[0],x2[1])+1) + "\n";
        return s;
    }
}
