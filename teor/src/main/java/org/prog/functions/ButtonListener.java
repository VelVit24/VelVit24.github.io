package org.prog.functions;

import org.apache.poi.xwpf.usermodel.*;

import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.*;

import org.prog.exemp.*;

public class ButtonListener implements ActionListener {
    JSpinner sp;
    JLabel lb;
    int[] ch;
    public ButtonListener(JSpinner sp, JLabel lb, int[] ch) {
        this.sp = sp;
        this.lb = lb;
        this.ch = ch;
    }
    public void actionPerformed(ActionEvent e) {
        lb.setText("");

        XWPFDocument document = new XWPFDocument();

        int n = (int) sp.getValue();
        for (int i = 0; i < n; i++) {

            XWPFParagraph title = document.createParagraph();
            title.setAlignment(ParagraphAlignment.CENTER);
            XWPFRun titleRun = title.createRun();
            titleRun.setText("Вариант " + (i+1));
            titleRun.setBold(true);
            titleRun.setFontFamily("Times New Roman");
            titleRun.setFontSize(20);

            String[] s1;
            if (ch[0] == 1) {
                Combinatory cb = new Combinatory();
                s1 = cb.getText();
                addtext(document, s1);
            }

            if (ch[1] == 1) {
                Rand_events re = new Rand_events();
                s1 = re.getText();
                addtext(document, s1);
            }

            if (ch[2] == 1) {
                Total_prob tp = new Total_prob();
                s1 = tp.getText();
                addtext(document, s1);
            }

            if (ch[3] == 1) {
                Bernoulli ber = new Bernoulli();
                s1 = ber.getText();
                addtext(document, s1);
            }

            if (ch[4] == 1) {
                Discrete_var dv = new Discrete_var();
                s1 = dv.getText();
                addtext(document, s1);
            }

            if (ch[5] == 1) {
                Countin_var cv = new Countin_var();
                s1 = cv.getText();
                addtext(document, s1);
            }

            if (ch[6] == 1) {
                Distrib db = new Distrib();
                s1 = db.getText();
                addtext(document, s1);
            }

            title.setPageBreak(true);
        }


        FileOutputStream out = null;
        boolean fl = true;
        try {
            out = new FileOutputStream(new File("Задания.docx"));
        } catch (FileNotFoundException ex) {
            lb.setText("Ошибка: Файл Задание.docx открыт в другой программе.");
            fl = false;
        }
        if (fl) {
            try {
                document.write(out);
                out.close();
                document.close();
            } catch (IOException ex) {
                System.out.println(ex.getMessage());
            }
        }

        document = new XWPFDocument();
        for (int i = 0; i < n; i++) {
            XWPFParagraph title = document.createParagraph();
            title.setAlignment(ParagraphAlignment.CENTER);
            XWPFRun titleRun = title.createRun();
            titleRun.setText("Вариант " + (i+1));
            titleRun.setBold(true);
            titleRun.setFontFamily("Times New Roman");
            titleRun.setFontSize(20);

            String[] s1;
            if (ch[0] == 1) {
                Combinatory cb = new Combinatory();
                s1 = cb.getAns();
                addtext(document, s1);
            }

            if (ch[1] == 1) {
                Rand_events re = new Rand_events();
                s1 = re.getAns();
                addtext(document, s1);
            }

            if (ch[2] == 1) {
                Total_prob tp = new Total_prob();
                s1 = tp.getAns();
                addtext(document, s1);
            }

            if (ch[3] == 1) {
                Bernoulli ber = new Bernoulli();
                s1 = ber.getAns();
                addtext(document, s1);
            }

            if (ch[4] == 1) {
                Discrete_var dv = new Discrete_var();
                s1 = dv.getAns();
                addtext(document, s1);
            }

            if (ch[5] == 1) {
                Countin_var cv = new Countin_var();
                s1 = cv.getAns();
                addtext(document, s1);
            }

            if (ch[6] == 1) {
                Distrib ds = new Distrib();
                s1 = ds.getAns();
                addtext(document, s1);
            }
            title.setPageBreak(true);
        }


        out = null;
        fl = true;
        try {
            out = new FileOutputStream(new File("Ответы.docx"));
        } catch (FileNotFoundException ex) {
            lb.setText("Ошибка: Файл Ответы.docx открыт в другой программе.");
            fl = false;
        }
        if (fl) {
            try {
                document.write(out);
                out.close();
                document.close();
            } catch (IOException ex) {
                System.out.println(ex.getMessage());
            }
        }
        lb.setText("Задания успешно сгенерированы и сохранены в папку с программой");
    }
    void addtext(XWPFDocument doc, String[] s) {
        for (String i : s) {
            XWPFParagraph p = doc.createParagraph();
            XWPFRun pr = p.createRun();
            pr.setFontFamily("Times New Roman");
            pr.setText(i);
        }
    }
}