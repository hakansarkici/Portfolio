public class post2rep extends AbstractAjoAccess {
 
    DbContext ctx = null;
  private static final int MARK_COLUMN_COUNT = 31;
  private static final int ROL_COLUMN_COUNT = 28;
  private static final int NFA_COLUMN_COUNT = 33;
  private static final int STO_COLUMN_COUNT = 34;

  @Override
  public int run(String[] args) {
      ctx = getDbContext();

      String kommission = HHFunc.Eingabe("Kommission eingeben:");

      String[] auswahl = { "Markise", "Fenster", "Rolladen", "NFA", "Stoff" };
      String produkt = HHFunc.Menu("Produkt", auswahl);

      Map<String, String> tableMapping = new HashMap<>();
      tableMapping.put("Markise", "public.arch_mar");
      tableMapping.put("Rolladen", "public.arch_rol");
      tableMapping.put("NFA", "public.arch_nfa");
      tableMapping.put("Stoff", "public.arch_sto");

      String tabelle = tableMapping.getOrDefault(produkt, "public.arch_martest");

      String jFile = "/erp/abas/demo/win/jasper/layout/hhjasper/markisen/DBFtoRep.jrxml";

      retrieveData(ctx, kommission, produkt, tabelle, jFile);

      return 0;
  }

  private void retrieveData(DbContext ctx, String kommission, String produkt, String tabelle, String jFile) {
      String jrFileName = jFile;
      String connPost = "jdbc:postgresql://192.168.6.129:5432/postgres";

      try (Connection conn = DriverManager.getConnection(connPost, "postgres", "db2su");
           PreparedStatement statement = conn.prepareStatement("SELECT * FROM " + tabelle + " WHERE komm = ?")) {
          statement.setString(1, kommission);

          ctx.out().println("Programm Gestartet.");

          try (ResultSet resultSet = statement.executeQuery()) {
              ResultSetMetaData metaData = resultSet.getMetaData();

              switch (tabelle) {
                  case "public.arch_mar":
                      rep(ctx, metaData, jrFileName, resultSet, MARK_COLUMN_COUNT, MarkData.class, tabelle);
                      break;
                  case "public.arch_rol":
                      rep(ctx, metaData, jrFileName, resultSet, ROL_COLUMN_COUNT, RolData.class, tabelle);
                      break;
                  case "public.arch_nfa":
                      rep(ctx, metaData, jrFileName, resultSet, NFA_COLUMN_COUNT, NfaData.class, tabelle);
                      break;
                  case "public.arch_sto":
                      rep(ctx, metaData, jrFileName, resultSet, STO_COLUMN_COUNT, StoData.class, tabelle);
                      break;
                  default:
                      break;
              }
          }
      } catch (SQLException e) {
          ctx.out().println(e.getMessage());
          Arrays.stream(e.getStackTrace()).forEach(ste -> ctx.out().println(ste.toString()));
      }
  }


    private <T> void rep(DbContext ctx, ResultSetMetaData metaData, String sJrFileName, ResultSet resultSet, int spaltenzahl, Class<T> clazz, String Tabelle) throws SQLException {
          List<String> ueberschriften = new ArrayList<>();
          List<String> felder = new ArrayList<>();

          for (int i = 1; i <= spaltenzahl; i++) {
                ueberschriften.add(metaData.getColumnName(i));
          }

          ctx.out().println("Daten abrufen:");

          List<T> dataList = new ArrayList<>();
          while (resultSet.next()) {
                dataList.add(createDataObject(resultSet, clazz));
          }

          dataLoop(spaltenzahl, felder, dataList, ueberschriften, clazz);

          CallJR.showReport(ctx, sJrFileName, (ArrayList<?>) createJasperList(felder, ueberschriften, spaltenzahl, clazz));
    }

    private <T> void dataLoop(int spaltenzahl, List<String> felder, List<T> dataList, List<String> ueberschriften, Class<T> clazz) {
          for (T data : dataList) {
                ctx.out().print(".");
                loop(spaltenzahl, felder, data, ueberschriften, clazz);
          }
    }

    private <T> void loop(int spaltenzahl, List<String> felder, T data, List<String> ueberschriften, Class<T> clazz) {
          for (int i = 1; i <= spaltenzahl; i++) {
                String methodName = "getValue" + i;
                try {
                      Method method = clazz.getMethod(methodName);
                      Object value = method.invoke(data);
                      felder.add(value != null ? value.toString() : " ");
                      ctx.out().print(value + "  " + ueberschriften.get(i - 1));
                } catch (NoSuchMethodException | IllegalAccessException | InvocationTargetException e) {
                      ctx.out().println(e.toString());
                }
          }
    }

    @SuppressWarnings("unchecked")
    private <T> List<T> createJasperList(List<String> felder, List<String> ueberschriften, int spaltenzahl, Class<T> clazz) {
          List<T> aljasp = new ArrayList<>();
          P2Rjasp fuelljasper = null;
          ;

          while (spaltenzahl % 6 != 0)
                spaltenzahl++;

          int zaehler = spaltenzahl / 6;
          int durchl = 0;
          for (int i = 0; i <= zaehler; i++) {
                fuelljasper = new P2Rjasp();

                int startIndex = i + durchl;

                if (startIndex < ueberschriften.size()) {
                      fuelljasper.setUeberschrift1(ueberschriften.get(startIndex));
                      fuelljasper.setField1(felder.get(startIndex));
                }

                if (startIndex + 1 < ueberschriften.size()) {
                      fuelljasper.setUeberschrift2(ueberschriften.get(startIndex + 1));
                      fuelljasper.setField2(felder.get(startIndex + 1));
                }

                if (startIndex + 2 < ueberschriften.size()) {
                      fuelljasper.setUeberschrift3(ueberschriften.get(startIndex + 2));
                      fuelljasper.setField3(felder.get(startIndex + 2));
                }

                if (startIndex + 3 < ueberschriften.size()) {
                      fuelljasper.setUeberschrift4(ueberschriften.get(startIndex + 3));
                      fuelljasper.setField4(felder.get(startIndex + 3));
                }

                if (startIndex + 4 < ueberschriften.size()) {
                      fuelljasper.setUeberschrift5(ueberschriften.get(startIndex + 4));
                      fuelljasper.setField5(felder.get(startIndex + 4));
                }

                if (startIndex + 5 < ueberschriften.size()) {
                      fuelljasper.setUeberschrift6(ueberschriften.get(startIndex + 5));
                      fuelljasper.setField6(felder.get(startIndex + 5));
                }

                // ... (similar for other fields)

                aljasp.add((T) fuelljasper);
                durchl = durchl + 5;
          }

          return aljasp;
    }

    private <T> T createDataObject(ResultSet rsDBF, Class<T> clazz) throws SQLException {
          try {
                T instance = clazz.getDeclaredConstructor().newInstance(); // Create
                                                                                                         // an
                                                                                                         // instance
                                                                                                         // using
                                                                                                         // the
                                                                                                         // default
                                                                                                         // constructor

                // Retrieve the ResultSet metadata to get column information
                ResultSetMetaData metaData = rsDBF.getMetaData();
                int columnCount = metaData.getColumnCount();

                // Iterate through the columns and set values in the object
                for (int i = 1; i <= columnCount; i++) {
                      // Get the column name and corresponding method name in the data
                      // object
                      String columnName = metaData.getColumnName(i);
                      String methodName = "set" + columnName; // Assuming your setter
                                                                                 // methods follow this
                                                                                 // naming convention

                      // Find the corresponding method in the data object class
                      Method method = Arrays.stream(clazz.getMethods()).filter(m -> m.getName().equalsIgnoreCase(methodName)).findFirst().orElse(null);

                      if (method != null) {
                            // Determine the data type of the column and set the value
                            // using the appropriate ResultSet method
                            Class<?> parameterType = method.getParameterTypes()[0];
                            Object columnValue = getColumnValue(rsDBF, i, parameterType);

                            // Invoke the setter method to set the value in the object
                            method.invoke(instance, columnValue);
                      }
                }

                return instance;
          } catch (InstantiationException | IllegalAccessException | InvocationTargetException | NoSuchMethodException e) {
                // Handle exceptions according to your requirements
                e.printStackTrace();
          }

          return null;
    }

    private Object getColumnValue(ResultSet rs, int columnIndex, Class<?> targetType) throws SQLException {
          // Add more cases as needed based on the data types you're working with
          if (targetType == String.class) {
                return rs.getString(columnIndex);
          } else if (targetType == Integer.class || targetType == int.class) {
                return rs.getInt(columnIndex);
          } else if (targetType == Double.class || targetType == double.class) {
                return rs.getDouble(columnIndex);
          }else if (targetType == Timestamp.class || targetType == Timestamp.class) {
                return rs.getTimestamp(columnIndex);
          }
          // Add more cases for other data types...

          return null;
    }

}