package prog.classes;
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
    public String getText() {
        String s = "Глава 4. Схема Бернулли\n";
        s += "1. В каждом из "+x1[2]+" ящиков по "+x1[0]+" белых и по "+x1[1]+" черных шаров. Из каждого ящика вынули по одному шару. " +
                "Какова вероятность вынуть "+x1[3]+" белых и "+(x1[2]-x1[3])+" черных шара?\n";
        s += "2. Пара одинаковых игральных костей бросается "+x2[0]+" раз. Какова вероятность того, что сумма очков, равная "+x2[1]+", выпадет:" +
                "а) ровно "+x2[2]+" раз;\n" +
                "б) не менее "+x2[2]+" раз?\n";
        s += "3. На телефонной станции неправильное соединение происходит с вероятностью "+x3+". Найти вероятность того, " +
                "что среди "+x4+" соединений произойдет менее трех неправильных.\n\n";
        return s;
    }
    public String getAns() {
        DecimalFormat df = new DecimalFormat("0.000");
        String s = "Глава 4\n";
        double p = ((double)x1[0])/((double)x1[0]+x1[1]);
        double t = Funct.comb(x1[2], x1[3]) * Math.pow(p,x1[3]) * Math.pow(1-p,x1[2]-x1[3]);
        s += "1. " + df.format(t);
        double np = x3*x4;
        s += "\n3. " + df.format(Math.exp(-np) + np*Math.exp(-np) + np*np*Math.exp(-np)) + "\n";
        return s;
    }
}
