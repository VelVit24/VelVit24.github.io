package prog;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.*;

public class Main {
    public static void main(String[] args) {
        JFrame f = new JFrame("My First GUI");
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        f.setSize(1000, 1000);

        JPanel panel1 = new JPanel();
        panel1.setLayout(new BoxLayout (panel1, BoxLayout.Y_AXIS));
        JLabel lt = new JLabel("Темы заданий");
        JLabel l1 = new JLabel("Задания 1-2: Комбинаторика");
        JLabel l2 = new JLabel("Задания 3-5: Случайные события");
        JLabel l3 = new JLabel("Задания 6-8: Формула полной вероятности");
        JLabel l4 = new JLabel("Задания 9-11: Схема Бернулли");
        JLabel l5 = new JLabel("Задания 12-15: Дискретные случайные величины");
        JLabel l6 = new JLabel("Задание 16: Непрерывные случайные величины и их числовые характеристики");
        JLabel l7 = new JLabel("Задания 17-19: Важнейшие законы распределения непрерывных случайных величин и их свойства");
        l1.setAlignmentX(Component.CENTER_ALIGNMENT);
        panel1.add(lt);
        panel1.add(l1);
        panel1.add(l2);
        panel1.add(l3);
        panel1.add(l4);
        panel1.add(l5);
        panel1.add(l6);
        panel1.add(l7);
        lt.setFont(new Font("Serif", Font.PLAIN, 18));
        l1.setFont(new Font("Serif", Font.PLAIN, 18));
        l2.setFont(new Font("Serif", Font.PLAIN, 18));
        l3.setFont(new Font("Serif", Font.PLAIN, 18));
        l4.setFont(new Font("Serif", Font.PLAIN, 18));
        l5.setFont(new Font("Serif", Font.PLAIN, 18));
        l6.setFont(new Font("Serif", Font.PLAIN, 18));
        l7.setFont(new Font("Serif", Font.PLAIN, 18));
        panel1.setBounds(0,0,1000,200);
        f.add(panel1);


        JPanel panel2 = new JPanel(new FlowLayout(FlowLayout.CENTER, 20, 0));
        JLabel label = new JLabel("Количество вариантов");
        label.setFont(new Font("Serif", Font.PLAIN, 18));
        label.setBounds(0,0,200,100);
        SpinnerModel value = new SpinnerNumberModel(5, 0, 10, 1);
        JSpinner spinner = new JSpinner(value);
        spinner.setSize(100,100);
        panel2.add(label); panel2.add(spinner);
        panel2.setBorder(BorderFactory.createLineBorder(Color.black));
        panel2.setBounds(0,200,1000,30);

        JButton b = new JButton("Сохранить");
        b.setBounds(0,230,1000,30);
        f.add(b);
        f.add(panel2);
        f.setLayout(null);
        f.setVisible(true);


        class List1 implements ActionListener {
            public void actionPerformed(ActionEvent e) {

            }
        }
        /*
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

         */
    }
}