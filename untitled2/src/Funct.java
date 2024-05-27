public class Funct {
    static long factorial(int n) {
        long fact = 1;
        for (int i = 1; i <= n; i++) {
            fact = fact * i;
        }
        return fact;
    }
    static double comb(int n, int k) {
        return (factorial(n)) / ((factorial(k) * factorial(n - k)));
    }
}
