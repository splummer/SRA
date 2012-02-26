 
      </div> <!-- /.span10 -->
      </div> <!-- /.row -->
      
      <hr />
      
      <footer>
        <p>SRA - Squirrel Registration Authority &copy; GAGG 2012</p>
      </footer>

    </div> <!-- /fluid-container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" language="Javascript" src="<?php echo asset_url();?>js/jquery-1.7.1.js"></script>
    <script type="text/javascript" language="Javascript" src="<?php echo asset_url();?>js/bootstrap.js"></script>
    <script type="text/javascript" language="Javascript" src="<?php echo asset_url();?>js/bootstrap-datepicker.js"></script>
    <script>
      /* Update datepicker plugin so that MM/DD/YYYY format is used. */
      $.extend($.fn.datepicker.defaults, {
      parse: function (string) {
        var matches;
        if ((matches = string.match(/^(\d{2,2})\/(\d{2,2})\/(\d{4,4})$/))) {
          return new Date(matches[3], matches[1] - 1, matches[2]);
        } else {
          return null;
        }
      },
      format: function (date) {
        var
          month = (date.getMonth() + 1).toString(),
          dom = date.getDate().toString();
        if (month.length === 1) {
          month = "0" + month;
        }
        if (dom.length === 1) {
          dom = "0" + dom;
        }
        return month + "/" + dom + "/" + date.getFullYear();
      }
      });  
    </script>


  </body>
</html>
