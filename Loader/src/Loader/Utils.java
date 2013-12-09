package Loader;

public class Utils
{
    public static String joinStringsWithCommas(String[] strings)
    {
        String result = "";
        for(String value : strings)
        {
            result += value + ",";
        }
        return result.length() > 0 ? result.substring(0, result.length() - 1): "";
    }
}
