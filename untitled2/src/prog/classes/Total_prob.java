package prog.classes;
import java.text.DecimalFormat;
import java.util.Random;
import prog.classes.*;

public class Total_prob {
    int []x1 = new int[3];
    double []x2 = new double[3];
    int []x3 = new int[3];
    double []x4 = new double[3];
    public Total_prob() {
        Random rn = new Random();
        x1[0] = rn.nextInt(7)+3;
        x1[1] = rn.nextInt(7)+3;
        x1[2] = rn.nextInt(x1[0]-2)+2;
        x2[0] = (rn.nextInt(8)+1)/10.0;
        x2[1] = (rn.nextInt(8)+1)/10.0;
        x2[2] = (rn.nextInt(8)+1)/10.0;
        x3[0] = (rn.nextInt(4)+1) * 10;
        x3[1] = (rn.nextInt(3)+1) * 10;
        x3[2] = 100 - x3[0] - x3[1];
        x4[0] = (rn.nextInt(8)+1)/10.0;
        x4[1] = (rn.nextInt(8)+1)/10.0;
        x4[2] = (rn.nextInt(8)+1)/10.0;
    }
    public String getText() {
        String s = "Глава 3. Формула полной вероятности\n";
        s += "1. На прилавке в магазине лежат "+x1[0]+" флеш-карты с объемом памяти 2GB и "+x1[1]+" флеш-карт с объемом памяти 4GB. " +
                "Продавец наугад взял "+x1[2]+" флеш-карты. Найти вероятность того, что все флеш-карты с объемом памяти 2GB.\n";
        s += "2. Ученому для научной статьи необходимо сделать несколько фотографий. Оборудование позволяет делать фотосъемку " +
                "неподвижных малых объектов с вероятностью брака "+x2[0]+", объектов в процессе исследования их под микроскопом — " +
                "с вероятностью брака "+x2[1]+" и аэродинамических струйных полей — с вероятностью брака "+x2[2]+". Редактор статьи выбирает " +
                "фотоснимок наугад. Какова вероятность того, что он будет качественным, если ученый сделал по три снимка каждого типа?\n";
        s += "3. У стоматолога три вида пломбирующего материала: цемент ("+x3[0]+"%), амальгама ("+x3[1]+"%) и пластмасса ("+x3[2]+"%). " +
                "Условия лечения таковы, что вероятность выпадения пломбы, сделанной из цемента, в течение первого года " +
                "после лечения равна "+x4[0]+", пломбы из амальгамы — "+x4[1]+", из пластмассы — "+x4[2]+". У пациента пломба выпала через " +
                "неделю. Из какого материала вероятнее всего она была сделана, если врач взял тот пломбирующий материал, " +
                "что оказался под рукой?\n\n";
        return s;
    }
    public String getAns() {
        DecimalFormat df = new DecimalFormat("0.000");
        String s = "Глава 3\n";
        s += "1. " + df.format(Funct.comb(x1[0], x1[2])/Funct.comb(x1[0]+x1[1], x1[2]));
        s += "\n2. " + df.format((0.3333333)*x2[0]+(0.3333333)*x2[1]+(0.3333333)*x2[2]);
        double t = (1.0/x3[0])*x4[0] + (1.0/x3[1])*x4[1] + (1.0/x3[2])*x4[2];
        double t1 = ((1.0/x3[0])*x4[0])/t, t2 = ((1.0/x3[1])*x4[1])/t, t3 = ((1.0/x3[2])*x4[2])/t;
        s += "\n3. "+df.format(t1)+", "+df.format(t2)+", "+df.format(t3)+"\n";
        return s;
    }
}
