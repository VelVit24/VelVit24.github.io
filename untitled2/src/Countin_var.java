import java.text.DecimalFormat;
import java.util.Random;

public class Countin_var {
    int []x1 = new int[7];
    int []x2 = new int[2];
    double x3;
    int x4, x5;
    Countin_var() {
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
    String getText() {
        String s = "Глава 6. Непрерывные случайные величины и их числовые характеристики \n";
        s += "1. Дана плотность вероятности f(x) непрерывной случайной величины X. Требуется: \n" +
                "1) найти параметр a; \n" +
                "2) найти функцию распределения F(x); \n" +
                "3) построить графики f(x) и F(x); \n" +
                "4) найти асимметрию и эксцесс X.\n" +
                "f(x) = { 0, x<="+x2[0]+";\n" +
                "       { a/x^"+x2[1]+", x>"+x2[0]+";\n" +
                " \n";
        return s;
    }
    String getAns() {
        DecimalFormat df = new DecimalFormat("0.000");
        String s = "Глава 6\n";
        s += "2. a) " + ((x2[1]-1)*Math.pow(x2[0], x2[1]-1)) + "\n";
        return s;
    }
}
