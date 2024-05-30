package org.prog.exemp;
import org.prog.functions.Funct;

import java.text.DecimalFormat;
import java.util.Random;

public class Bernoulli {
    int []x1 = new int[4];
    int []x2 = new int[3];
    double x3;
    int x4, x5;
    public Bernoulli() {
        Random rn = new Random();
        x1[0] = rn.nextInt(16)+4;
        x1[1] = rn.nextInt(16)+4;
        x1[2] = rn.nextInt(3)+3;
        x1[3] = rn.nextInt(x1[2]-2)+1;

        x2[0] = rn.nextInt(30)+35;
        x2[1] = rn.nextInt(6)+4;
        x2[2] = rn.nextInt(8)+8;

        x3 = (rn.nextInt(8)+1)/1000.0;
        x4 = rn.nextInt(100)+150;
    }
    public String[] getText() {
        String[] s = new String[5];
        s[0] = "9. В каждом из "+x1[2]+" ящиков по "+x1[0]+" белых и по "+x1[1]+" черных шаров. Из каждого ящика вынули по одному шару. " +
                "Какова вероятность вынуть "+x1[3]+" белых и "+(x1[2]-x1[3])+" черных шара?";
        s[1] = "10. Пара одинаковых игральных костей бросается "+x2[0]+" раз. Какова вероятность того, что сумма очков, равная "+x2[1]+", выпадет:";
        s[2] = "а) ровно "+x2[2]+" раз;";
        s[3] = "б) не менее "+x2[2]+" раз?";
        s[4] = "11. На телефонной станции неправильное соединение происходит с вероятностью "+x3+". Найти вероятность того, " +
                "что среди "+x4+" соединений произойдет менее трех неправильных.";
        return s;
    }
    public String[] getAns() {
        DecimalFormat df = new DecimalFormat("0.000");
        String[]s = new String[4];
        double p = ((double)x1[0])/((double)x1[0]+x1[1]);
        double t = Funct.comb(x1[2], x1[3]) * Math.pow(p,x1[3]) * Math.pow(1-p,x1[2]-x1[3]);
        s[0] = "9. " + df.format(t);
        double[] t1 = {(double) 3 /36, (double) 4 /36, (double) 5 /36, (double) 6 /36, (double) 5 /36, (double) 4 /36, (double) 3 /36};
        double p2 = t1[x2[1]-4];
        double x = (x2[2]-x2[0]*p2)/Math.sqrt(x2[0]*p2*(1-p2));
        s[1] = "10. a) " + df.format((1.0/Math.sqrt(x2[0]*p2*(1-p2)))*Funct.laplacePR(x));
        double xx1 = (x2[2]-x2[0]*p2)/Math.sqrt(x2[0]*p2*(1-p2));
        double xx2 = (x2[0]-x2[0]*p2)/Math.sqrt(x2[0]*p2*(1-p2));
        double np = x3*x4;
        s[2] = "      b) " + df.format(Funct.laplace(xx2) - Funct.laplace(xx1));
        s[3] = "11. " + df.format(Math.exp(-np) + np*Math.exp(-np) + np*np*Math.exp(-np));
        return s;
    }
}
