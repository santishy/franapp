
class ResizeObs{
    
    constructor(){
        this.el  = document.querySelector("body");
        this.width = this.el.clientWidth;
        this.handleObserverResize = this.handleObserverResize.bind(this);
        this.calculateWindowWidth()
    }
    get windowWidth(){
        return this.width;
    }
    calculateWindowWidth(){
        const sizeObserver = new ResizeObserver(this.handleObserverResize);
        sizeObserver.observe(this.el);
    }
    handleObserverResize(entries){
        for(let entry of entries){
            if(entry?.contentBoxSize){
                if(Array.isArray(entry.contentBoxSize))
                {
                    this.width = entry.contentBoxSize[0].inlineSize;
                    console.log('width: ',this.windowWidth)
                }
            }
        }
    }
}

export default ResizeObs;