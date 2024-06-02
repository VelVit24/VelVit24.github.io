package org.prog.exemp;
import org.prog.functions.Funct;

import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.Iterator;
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
        x1[0] = (rn.nextInt(5)+3)/10.0;
        x1[1] = (rn.nextInt(5)+3)/10.0;

        x2[0] = rn.nextInt(5)+1;
        x2[1] = rn.nextInt(3)+3;

        x31 = (rn.nextInt(6)+2)*1000;
        x32 = (rn.nextInt(8)+1)/10000.0;

        x4[0] = rn.nextInt(5)+1;
        x4[1] = rn.nextInt(5)+1;
        x4[2] = rn.nextInt(5)+x4[1]+1;
        x4[3] = rn.nextInt(5)+1;
        x4[4] = rn.nextInt(5)+x4[3]+1;

        x5[0] = (rn.nextInt(5)+1)/10.0;
        x5[1] = (rn.nextInt(3)+1)/10.0;
        x5[2] = (rn.nextInt(8)+1)/10.0;
        x5[3] = 1.0 - x5[2];
    }
    public String[] getText() {
        String[] s = new String[9];
        DecimalFormat df = new DecimalFormat("0.0000");
        s[0] = "12. Из двух орудий поочередно ведется стрельба по цели до первого попадания одним из орудий. Вероятность попадания в цель для первого " +
                "орудия равна "+x1[0]+", для второго — "+x1[1]+". Начинает стрельбу первое орудие. Составить ряд распределения дискретной случайной величины " +
                "X — числа снарядов, израсходованных первым орудием. Найти М(Х), D(X), (X), F(X) этой случайной величины. Построить график F(X).";
        s[1] = "13. Составить ряд распределения числа выпадений числа "+x2[0]+", если игральная кость брошена "+x2[1]+" раза. Найти M(X) и D(X) этой случайной величины.";
        s[2] = "14. Завод отправил на базу "+x31+" доброкачественных изделий. Вероятность того, что в пути изделие повредится, равна "+df.format(x32)+". Составить ряд " +
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
        DecimalFormat df2 = new DecimalFormat("0.00");
        String[] s = new String[24];
        double t1 = x1[0]+(1.0-x1[0])*x1[1], t2 = (1-x1[0])*(1-x1[1]);
        double mx1 = t1/(Math.pow(1-t2,2));
        s[0] = "12. X |    1    |    2    |    3    |    4    | ...";
        s[1] = "     P | " + df.format(t1) + " | " + df.format(t2*t1) + " | " + df.format(t2*t2*t1) + " | " + df.format(t2*t2*t2*t1) + " | ...";
        s[2] = "     M(X) = " + df.format(mx1);
        double m2 = t1*((1+t2)/Math.pow(1-t2,3));
        double dx1 = m2 - Math.pow(mx1,2);
        s[3] = "     D(X) = " + df.format(dx1);
        s[4] = "     σ(x) = " + df.format(Math.sqrt(dx1));

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

        s[5] = "13. X";
        for (int i = 0; i < x2[1]+1; i++) {
            s[5] += "    |    " + t3[i];
        }
        s[6] = "    P";
        for (int i = 0; i < x2[1]+1; i++) {
            s[6] += " | " + df.format(p[i]);
        }
        s[7] = "    M(X) = " + df2.format(mx);
        s[8] = "    D(X) = " + df2.format(dx);

        s[9] = "14. X |    0    |    1    |    2    |    3    | ...";
        s[10] ="      P | " + df.format(Funct.puason(0,x31,x32)) + " | " + df.format(Funct.puason(1,x31,x32)) + " | "
                + df.format(Funct.puason(2,x31,x32)) + " | " + df.format(Funct.puason(3,x31,x32)) + " | ...";
        s[11] ="      M(X) = " + df2.format(x31*x32);

        double x5p = 1 - x5[0] - x5[1];
        mx = x4[0]*x5p + x4[1]*x5[0] + x4[2]*x5[1];
        mx2 = x4[0]*x4[0]*x5p + x4[1]*x4[1]*x5[0] + x4[2]*x4[2]*x5[1];
        double my = x4[3]*x5[2] + x4[4]*x5[3];
        double my2 = x4[3]*x4[3]*x5[2] + x4[4]*x4[4]*x5[3];
        dx = mx2 - mx*mx;
        double dy = my2 - my*my;

        ArrayList<Integer> z1x = new ArrayList<>();
        ArrayList<Double> z1p = new ArrayList<>();
        ArrayList<Integer> z2x = new ArrayList<>();
        ArrayList<Double> z2p = new ArrayList<>();

        z1x.add((-x4[0])*2+x4[3]); z1x.add((-x4[0])*2+x4[4]);
        z2x.add((-x4[0])*x4[3]); z2x.add((-x4[0])*x4[4]);
        for (int i = 0; i < 2; i ++) {
            for (int j = 0; j < 2; j ++) {
                z1x.add(x4[i+1]*2+x4[j+3]);
                z2x.add(x4[i+1]*x4[j+3]);
            }
        }
        z1p.add(x5p*x5[2]); z1p.add(x5p*x5[3]);
        z2p.add(x5p*x5[2]); z2p.add(x5p*x5[3]);
        for (int i = 0; i < 2; i ++) {
            for (int j = 0; j < 2; j++) {
                z1p.add(x5[i]*x5[j+2]);
                z2p.add(x5[i]*x5[j+2]);
            }
        }

        for (int i = 0; i < 6; i ++) {
            for (int j = 0; j < 5; j++) {
                if (z1x.get(j) > z1x.get(j+1)) {
                    int t = z1x.get(j);
                    z1x.set(j, z1x.get(j+1));
                    z1x.set(j+1, t);
                    double t12 = z1p.get(j);
                    z1p.set(j, z1p.get(j+1));
                    z1p.set(j+1, t12);
                }
            }
        }
        for (int i = 0; i < 6; i ++) {
            for (int j = 0; j < 5; j++) {
                if (z2x.get(j) > z2x.get(j+1)) {
                    int t = z2x.get(j);
                    z2x.set(j, z2x.get(j+1));
                    z2x.set(j+1, t);
                    double t12 = z2p.get(j);
                    z2p.set(j, z2p.get(j+1));
                    z2p.set(j+1, t12);
                }
            }
        }

        Iterator<Integer> i1x = z1x.iterator();
        Iterator<Double> i1p = z1p.iterator();
        int x1 = i1x.next(), i1 = 0, x2;
        double p1 = i1p.next(), p2;
        while (i1x.hasNext()) {
            x2 = i1x.next();
            p2 = i1p.next();
            if (x1 == x2) {
                i1x.remove();
                z1p.set(i1, p1+p2);
                i1p.remove();
            }
            else {
                i1++;
                x1 = x2;
                p1 = p2;
            }
        }

        Iterator<Integer> i2x = z2x.iterator();
        Iterator<Double> i2p = z2p.iterator();
        x1 = i2x.next(); i1 = 0;
        p1 = i2p.next();
        while (i2x.hasNext()) {
            x2 = i2x.next();
            p2 = i2p.next();
            if (x1 == x2) {
                i2x.remove();
                z2p.set(i1, p1+p2);
                i2p.remove();
            }
            else {
                i1++;
                x1 = x2;
                p1 = p2;
            }
        }

        s[12] = "15. M(X) " + df2.format(mx);
        s[13] = "     M(Y) " + df2.format(my);
        s[14] = "     D(X) " + df2.format(dx);
        s[15] = "     D(Y) " + df2.format(dy);
        s[16] = "     Z1";
        s[17] = "     P";
        for (int j = 0; j < z1x.size(); j ++) {
            s[16] += "  |  " + z1x.get(j);
            s[17] += " | " + df2.format(z1p.get(j));
        }
        s[18] = "     Z2";
        s[19] = "     P";
        for (int j = 0; j < z2p.size(); j ++) {
            s[18] += "  |  " + z2x.get(j);
            s[19] += " | " + df2.format(z2p.get(j));
        }
        double mz1 = 0, mz2 = 0, mz12 = 0, mz22 = 0;
        for (int i = 0; i < z1x.size(); i++) {
            mz1 += z1x.get(i)*z1p.get(i);
            mz12 += z1x.get(i)*z1x.get(i)*z1p.get(i);
        }
        for (int i = 0; i < z2x.size(); i++) {
            mz2 += z2x.get(i)*z2p.get(i);
            mz22 += z2x.get(i)*z2x.get(i)*z2p.get(i);
        }
        double dz1 = mz12 - mz1*mz1, dz2 = mz22 - mz2*mz2;
        s[20] = "     M(Z1) = " + df2.format(mz1);
        s[21] = "     M(Z2) = " + df2.format(mz2);
        s[22] = "     D(Z1) = " + df2.format(dz1);
        s[23] = "     D(Z2) = " + df2.format(dz2);
        return s;
    }
}
