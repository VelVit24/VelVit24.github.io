package prog.classes;

import javax.swing.*;

public class MyFrame extends JFrame {
    MyFrame () {
        setSize (500, 500);
        setDefaultCloseOperation (JFrame.EXIT_ON_CLOSE);
        MyPanel panel = new MyPanel();
        add(panel);
        setVisible (true);
    }
}
