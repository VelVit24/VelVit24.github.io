package org.prog;

import org.prog.functions.ButtonListener;
import org.prog.functions.Funct;

import javax.swing.*;
import javax.swing.border.EmptyBorder;
import java.awt.*;

public class Main {
    public static void main(String[] args) {
        JFrame f = new JFrame("Генератор вариантов");
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        f.setSize(1000, 650);

        JPanel panel1 = new JPanel();
        panel1.setLayout(new BoxLayout(panel1, BoxLayout.Y_AXIS));
        panel1.setBounds(0,0,1000,220);
        panel1.setBorder(BorderFactory.createLineBorder(Color.black));
        panel1.setBorder(new EmptyBorder(0, 0, 10, 0));
        JPanel pt1 = new JPanel();
        panel1.add(pt1);
        JLabel lt = new JLabel("Темы заданий", JLabel.CENTER);
        lt.setFont(new Font("Calibri", Font.PLAIN, 22));
        pt1.add(lt);

        JLabel l1 = new JLabel("Задания 1-2: Комбинаторика");
        JLabel l2 = new JLabel("Задания 3-5: Случайные события");
        JLabel l3 = new JLabel("Задания 6-8: Формула полной вероятности");
        JLabel l4 = new JLabel("Задания 9-11: Схема Бернулли");
        JLabel l5 = new JLabel("Задания 12-15: Дискретные случайные величины");
        JLabel l6 = new JLabel("Задание 16: Непрерывные случайные величины и их числовые характеристики");
        JLabel l7 = new JLabel("Задания 17-19: Важнейшие законы распределения непрерывных случайных величин и их свойства");
        panel1.add(l1);
        panel1.add(l2);
        panel1.add(l3);
        panel1.add(l4);
        panel1.add(l5);
        panel1.add(l6);
        panel1.add(l7);
        l1.setFont(new Font("Calibri", Font.PLAIN, 18));
        l2.setFont(new Font("Calibri", Font.PLAIN, 18));
        l3.setFont(new Font("Calibri", Font.PLAIN, 18));
        l4.setFont(new Font("Calibri", Font.PLAIN, 18));
        l5.setFont(new Font("Calibri", Font.PLAIN, 18));
        l6.setFont(new Font("Calibri", Font.PLAIN, 18));
        l7.setFont(new Font("Calibri", Font.PLAIN, 18));


        JPanel panel2 = new JPanel();
        panel2.setLayout(new BoxLayout(panel2, BoxLayout.Y_AXIS));
        panel2.setBounds(0,230,1000,270);
        JPanel pt2 = new JPanel();
        panel2.add(pt2);
        JLabel title = new JLabel("Выбрать задания", JLabel.CENTER);
        title.setFont(new Font("Calibri", Font.PLAIN, 22));
        JCheckBox[] check = new JCheckBox[7];
        check[0] = new JCheckBox("Комбинаторика", true);
        check[0].setFont(new Font("Calibri", Font.PLAIN, 18));
        check[1] = new JCheckBox("Случайные события", true);
        check[1].setFont(new Font("Calibri", Font.PLAIN, 18));
        check[2] = new JCheckBox("Формула полной вероятности", true);
        check[2].setFont(new Font("Calibri", Font.PLAIN, 18));
        check[3] = new JCheckBox("Схема Бернулли", true);
        check[3].setFont(new Font("Calibri", Font.PLAIN, 18));
        check[4] = new JCheckBox("Дискретные случайные величины", true);
        check[4].setFont(new Font("Calibri", Font.PLAIN, 18));
        check[5] = new JCheckBox("Непрерывные случайные величины и их числовые характеристики", true);
        check[5].setFont(new Font("Calibri", Font.PLAIN, 18));
        check[6] = new JCheckBox("Важнейшие законы распределения непрерывных случайных величин и их свойства", true);
        check[6].setFont(new Font("Calibri", Font.PLAIN, 18));
        int[] checks = new int[7];
        for (int i = 0; i < 7; i++) {checks[i]=1;}
        check[0].addItemListener(e -> checks[0] = (e.getStateChange()==1?1:0));
        check[1].addItemListener(e -> checks[1] = (e.getStateChange()==1?1:0));
        check[2].addItemListener(e -> checks[2] = (e.getStateChange()==1?1:0));
        check[3].addItemListener(e -> checks[3] = (e.getStateChange()==1?1:0));
        check[4].addItemListener(e -> checks[4] = (e.getStateChange()==1?1:0));
        check[5].addItemListener(e -> checks[5] = (e.getStateChange()==1?1:0));
        check[6].addItemListener(e -> checks[6] = (e.getStateChange()==1?1:0));

        pt2.add(title);
        for (int i = 0; i < 7; i++) {panel2.add(check[i]);}

        JPanel panel3 = new JPanel(new FlowLayout(FlowLayout.CENTER, 20, 0));

        JLabel label = new JLabel("Количество вариантов");
        label.setFont(new Font("Calibri", Font.PLAIN, 20));
        label.setBounds(0,0,200,100);

        SpinnerModel value = new SpinnerNumberModel(5, 1, 50, 1);
        JSpinner spinner = new JSpinner(value);
        spinner.setSize(100,100);
        panel3.add(label); panel3.add(spinner);
        panel3.setBorder(new EmptyBorder(10, 0, 10, 0));
        panel3.setBounds(0,500,1000,40);

        JButton b = new JButton("Создать");
        b.setFont(new Font("Calibri", Font.PLAIN, 18));
        b.setBackground(Color.decode("#c3e4e9"));
        b.setBounds(0,540,1000,30);

        JPanel errpanel = new JPanel();
        errpanel.setBounds(0,570,1000,30);
        JLabel errlabel = new JLabel();
        ButtonListener bl = new ButtonListener(spinner, errlabel, checks);
        b.addActionListener(bl);

        errpanel.add(errlabel);
        f.add(b);
        f.add(panel1);
        f.add(panel2);
        f.add(panel3);
        f.add(errpanel);
        f.setLayout(null);
        f.setVisible(true);

        System.out.println(Funct.comb(3,2)/Funct.comb(12,2));
    }
}