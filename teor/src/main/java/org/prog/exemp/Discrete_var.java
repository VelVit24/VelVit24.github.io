package org.prog.exemp;
import org.prog.functions.Funct;

import java.text.DecimalFormat;
import java.util.Random;

public class Discrete_var {
    double []x1 = new double[2];
    int []x2 = new int[2];
    int x31;
    double x32;
    int []x4 = new int[5];
    double []x5 = new double[4];
    public Discrete_var() {
        Random rn = new Random();
        x1[0] = (rn.nextInt(8)+1)/10.0;
        x1[1] = (rn.nextInt(8)+1)/10.0;

        x2[0] = rn.nextInt(5)+1;
        x2[1] = rn.nextInt(3)+3;

        x31 = (rn.nextInt(6)+2)*1000;
        x32 = (rn.nextInt(8)+1)/10000.0;

        x4[0] = rn.nextInt(5)+1;
        x4[1] = rn.nextInt(5)+1;
        x4[2] = rn.nextInt(5)+x4[1]+1;
        x4[3] = rn.nextInt(5)+1;
        x4[4] = rn.nextInt(5)+x4[2]+1;

        x5[0] = (rn.nextInt(5)+1)/10.0;
        x5[1] = (rn.nextInt(3)+1)/10.0;
        x5[2] = (rn.nextInt(8)+1)/10.0;
        x5[3] = 1.0 - x4[3];
    }
    public String[] getText() {
        String[] s = new String[9];
        s[0] = "12. Из двух орудий поочередно ведется стрельба по цели до первого попадания одним из орудий. Вероятность попадания в цель для первого " +
                "орудия равна "+x1[0]+", для второго — "+x1[1]+". Начинает стрельбу первое орудие. Составить ряд распределения дискретной случайной величины " +
                "X — числа снарядов, израсходованных первым орудием. Найти М(Х), D(X), (X), F(X) этой случайной величины. Построить график F(X).";
        s[1] = "13. Составить ряд распределения числа выпадений числа "+x2[0]+", если игральная кость брошена "+x2[1]+" раза. Найти M(X) и D(X) этой случайной величины.";
        s[2] = "14. Завод отправил на базу "+x31+" доброкачественных изделий. Вероятность того, что в пути изделие повредится, равна "+x32+". Составить ряд " +
                "распределения числа негодных изделий, прибывших на базу. Найти M(X) этой случайной величины.";
        s[3] = "15. Независимые случайные величины X и Y заданы таблицами распределений. Найти:";
        s[4] = "1) M(X), M(Y), D(X), D(Y);";
        s[5] = "2) таблицы распределения случайных величин Z1 = = 2X+Y, Z2 = X+Y;";
        s[6] = "3) M(Z1), M(Z2), D(Z1), D(Z2) непосредственно по таблицам распределений и на основании свойств математического ожидания и дисперсии.";
        s[7] = "X | -"+x4[0]+" |  "+x4[1]+"  |  "+x4[2]+"     Y |  "+x4[3]+"  |  "+x4[4];
        s[8] = "P |  p | "+x5[0]+" | "+x5[1]+"    P | "+x5[2]+" | "+x5[3];
        return s;
    }
    public String[] getAns() {
        DecimalFormat df = new DecimalFormat("0.000");
        String[] s = new String[12];
        double t1 = 1-x1[0]*x1[1], t2 = x1[0]*x1[1];
        s[0] = "12. M(X) = " + df.format(1.0/t1);
        double m2 = t1*((1+t2)/Math.pow(1-t2,3));
        s[1] = "    D(X) = " + df.format(m2 - Math.pow(1.0/t1,2));
        s[2] = "    o'(x) = " + df.format(Math.sqrt(m2 - Math.pow(1.0/t1,2)));

        int[] t3 = new int[x2[1]+1];
        for (int i = 0; i < x2[1]+1; i++) {t3[i] = i;}
        double[] p = new double[x2[1]+1];
        for (int i = 0; i < x2[1]+1; i++) {
            p[i] = Funct.comb(x2[1], i) * Math.pow(1.0/6.0, i) * Math.pow(5.0/6.0, x2[1]-i);
        }
        double mx = 0, mx2 = 0;
        for (int i = 0; i < x2[1]+1; i++) {
            mx += ((double)t3[i]) * p[i];
            mx2 += ((double)t3[i]*t3[i]) * p[i];
        }
        double dx = mx2 - mx*mx;

        s[3] = "13. X";
        for (int i = 0; i < x2[1]+1; i++) {
            s[3] += " |    " + t3[i];
        }
        s[4] = "    P";
        for (int i = 0; i < x2[1]+1; i++) {
            s[4] += " | " + df.format(p[i]);
        }
        s[5] = "    M(X) = " + mx;
        s[6] = "    D(X) = " + dx;

        s[7] = "14. M(X) = " + df.format(x31*x32);

        double x5p = 1 - x5[0] - x5[1];
        mx = x4[0]*x5p + x4[1]*x5[0] + x4[2]*x5[1];
        mx2 = x4[0]*x4[0]*x5p + x4[1]*x4[1]*x5[0] + x4[2]*x4[2]*x5[1];
        double my = x4[3]*x5[2] + x4[4]*x5[3];
        double my2 = x4[3]*x4[3]*x5[2] + x4[4]*x4[4]*x5[3];
        dx = mx2 - mx*mx;
        double dy = my2 - my*my;
        s[8] = "15. M(X) " + mx;
        s[9] = "     M(Y) " + my;
        s[10] = "    D(X) " + dx;
        s[11] = "    D(Y) " + dy;
        return s;
    }
}
