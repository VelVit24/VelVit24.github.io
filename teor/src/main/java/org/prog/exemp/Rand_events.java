package org.prog.exemp;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.Random;

public class Rand_events {
    double []x1 = new double[2];
    double []x2 = new double[2];
    String s1,s2,s3, a1,a2,a3;
    public Rand_events(){
        Random rn = new Random();
        ArrayList<String> arr = new ArrayList<>();
        arr.add("из трех событий не произошло ни одного");
        arr.add("из трех событий произошло хотя бы одно");
        arr.add("из трех событий произошло ровно одно");
        arr.add("из трех событий произошло ровно два");
        arr.add("все события произошли");
        arr.add("из трех событий произошло хотя бы два");
        ArrayList<String> ans = new ArrayList<>();
        ans.add("A'*B'*C'");
        ans.add("1 - A'*B'*C'");
        ans.add("A*B'*C' + A'*B*C' + A'*B'*C");
        ans.add("A*B*C' + A'*B*C + A*B'*C");
        ans.add("A*B*C");
        ans.add("A*B*C' + A'*B*C + A*B'*C + A*B*C");
        int x = rn.nextInt(arr.size()-1);
        s1 = arr.get(x);
        a1 = ans.get(x);
        arr.remove(x);
        ans.remove(x);
        x = rn.nextInt(arr.size()-1);
        s2 = arr.get(x);
        a2 = ans.get(x);
        arr.remove(x);
        ans.remove(x);
        x = rn.nextInt(arr.size()-1);
        s3 = arr.get(x);
        a3 = ans.get(x);
        arr.remove(x);
        ans.remove(x);
        x1[0] = (rn.nextInt(6)+2)/10.0;
        x1[1] = (rn.nextInt(6)+2)/10.0;
        x2[0] = (rn.nextInt(6)+2)/10.0;
        x2[1] = (rn.nextInt(6)+2)/10.0;
    }
    public String[] getText() {
        String[] s = new String[6];
        s[0] = "3. Пусть A, B, C — три события, наблюдаемые в данном эксперименте. " +
                "Выразите в алгебре событий {A, B, C} следующее: E1 — "+s1+"; " +
                "E2 — "+s2+"; E3 — "+s3+".";
        s[1] = "4. Студент ест на завтрак бананы с кефиром и яичницу с ветчиной с вероятностями "+x1[0]+" и "+x1[1]+" соответственно. " +
                "Какова вероятность того, что субботним утром он предпочтет:";
        s[2] = "а) и то, и другое;";
        s[3] = "б) только бананы;";
        s[4] = "в) что-нибудь еще?";
        s[5] = "5. В конкурсе (из трех туров) на участие в полете на Луну участвуют российская женщина-космонавт и американский астронавт. " +
                "Вероятности успешно пройти любой из туров конкурса для них равны "+x2[0]+" и "+x2[1]+" соответственно. " +
                "Какова вероятность того, что американец на Луну не полетит (т. е. успешно пройденных туров у него окажется меньше)?";
        return s;
    }
    public String[] getAns() {
        DecimalFormat df = new DecimalFormat("0.000");
        String[] s = new String[3];
        s[0] = "3. a) " + a1 + "; b) " + a2 + "; c) " + a3;
        s[1] = "4. a) " + df.format(x1[0]*x1[1]) + "; b) " + df.format(x1[0]*(1-x1[1])) + "; c) " + df.format(1-(x1[0]+x1[1]-x1[0]*x1[1]));
        double y1 = (1-x2[1])*(1-x2[1])*(1-x2[1])*(x2[0]*(1-x2[1])*(1-x2[1])*3 + x2[0]*x2[0]*(1-x2[1])*3 + x2[0]*x2[0]*x2[0]);
        double y2 = x2[1]*(1-x2[1])*(1-x2[1])*3*(x2[0]*x2[0]*(1-x2[1])*3 + x2[0]*x2[0]*x2[0]);
        double y3 = x2[1]*x2[1]*(1-x2[1])*3*x2[0]*x2[0]*x2[0];
        s[2] = "5. " + df.format(y1+y2+y3) + "\n";
        return s;
    }
}
