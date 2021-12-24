/**
 * Used to show the chrismas light in december month.
 */
 class ChristmasLight {
    /**
     * Constructor.
     */
    constructor(document){
        this.document = document;
      this.date = new Date();
      this.currentMonth = this.date.getMonth();
      this.currentDay = (('0' + (this.date.getDate())).slice(-2)).toString();
    }
   
    /**
     * Prints out the html to render on HTML page.
     * This method can be renderes from anywhere in the DOM.
     */
    printHtml(){
        // It's not december yet or it's after 24th december.
        // December month is defined as 11 in the JS datetime getMonth()
        if (parseInt(this.currentMonth) != 11 || parseInt(this.currentMonth) != 11 && parseInt(this.currentDay) > 24){
        return;
      }
   
      // Store the HTML string to render
      const htmlString = `
          <div style="
            position: fixed;
          bottom: 0;
          width: 86px;
          height: 186px;
          z-index: -999;
          background: url(assets/images/julelys/day` + this.currentDay + `.png) left no-repeat;
          pointer-events: none;
        "></div>`;
   
      // Write to DOM
      this.document.write(htmlString);
    }
  }
  
  // For later use
  const G_ChrismasLight = new ChristmasLight(document);
  G_ChrismasLight.printHtml(); 
  