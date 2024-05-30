package prog;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import prog.classes.*;

public class Main {
    public static void main(String[] args) {
        try {
            File f = new File("text.txt");
            FileWriter fw = new FileWriter("text.txt", false);
            Combinatory cb = new Combinatory();
            fw.write(cb.getText());
            Rand_events re = new Rand_events();
            fw.write(re.getText());
            Total_prob tp = new Total_prob();
            fw.write(tp.getText());
            Bernoulli ber = new Bernoulli();
            fw.write(ber.getText());
            Discrete_var dv = new Discrete_var();
            fw.write(dv.getText());
            Countin_var cv = new Countin_var();
            fw.write(cv.getText());
            Distrib ds = new Distrib();
            fw.write(ds.getText());
            fw.write("\n\nОтветы:\n");
            fw.write(cb.getAns());
            fw.write(re.getAns());
            fw.write(tp.getAns());
            fw.write(ber.getAns());
            fw.write(dv.getAns());
            fw.write(cv.getAns());
            fw.close();
        }
        catch (IOException e) {
            e.printStackTrace();
        }
    }
}