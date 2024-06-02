package org.prog.functions;

public class Funct {
    public static long factorial(int n) {
        long fact = 1;
        for (int i = 1; i <= n; i++) {
            fact = fact * i;
        }
        return fact;
    }
    public static double comb(int n, int k) {
        return (double) (factorial(n)) / ((factorial(k) * factorial(n - k)));
    }
    public static double laplace(double x) {
        int n = 1000000;
        double sum = 0;
        int a = -10;
        double h = (x-a)/n;
        double y;
        for (int i = 0; i < n; i++) {
            y = a + i * h;
            sum += h * Math.exp(-(y*y/2));
        }
        sum *= (1/Math.sqrt(2*Math.PI));
        return sum;
    }
    public static double laplacePR(double x) {
        double y = (1.0/(Math.sqrt(2*Math.PI))) * Math.exp(-(x*x/2));
        return y;
    }
    public static double countinInterg(int a, int p) {
        int n = 1000000;
        int b = 1000000;
        double sum = 0;
        double h = ((double)b-a)/n;
        double y;
        for (int i = 0; i < n; i++) {
            y = a + i * h;
            sum += h * (1.0/(Math.pow(y,p)));
        }
        return 1.0/sum;
    }
}
