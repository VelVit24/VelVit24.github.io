import java.util.Random;

public class Distrib {
    int x12;
    double x11;
    int []x2 = new int[3];
    int []x3 = new int[3];
    Distrib() {
        Random rn = new Random();
        x11 = (rn.nextInt(8)+1)/1000.0;
        x12 = (rn.nextInt(5)+3)*10;
        x2[0] = (rn.nextInt(10)+5)*10;
        x2[1] = rn.nextInt(6)+4;
        x2[2] = rn.nextInt(x2[1])+(x2[0]-x2[1]);

        x3[0] = (rn.nextInt(6)+7)*10;
        x3[1] = (rn.nextInt(4)+1)*5;
        x3[2] = x3[0] - (rn.nextInt(4)+2)*5;
    }
    String getText() {
        String s = "Глава 7. Важнейшие законы распределения непрерывных случайных величин и их свойства\n";
        s += "1. Срок службы T (в часах) микросхемы — случайная величина, распределенная экспоненциально (λ = "+x11+"). " +
                "Указать плотность вероятности и функцию распределения T, построить их графики, найти средний срок службы микросхемы. " +
                "Какова вероятность того, что она прослужит более "+x12+" ч?\n";
        s += "2. Автомат отливает чугунные болванки. Стандартная масса отливки равна "+x2[0]+" кг. " +
                "Фактически масса отливки X имеет нормальное распределение (m = "+x2[0]+" кг). При контроле работы автомата обнаружено, " +
                "что масса изготовленных отливок находится в диапазоне от "+(x2[0]-x2[1])+" до "+(x2[0]+x2[1])+" кг. " +
                "Какова вероятность того, что масса очередной отливки будет больше "+x2[2]+" кг?\n";
        s += "3. Время формирования поезда на станции Узловая подчинено нормальному закону с математическим ожиданием "+x3[0]+" мин и средним " +
                "квадратическим отклонением "+x3[1]+" мин. Насколько вероятно, что очередной поезд будет сформирован менее чем за "+x3[2]+" мин?\n\n";
        return s;
    }
}
