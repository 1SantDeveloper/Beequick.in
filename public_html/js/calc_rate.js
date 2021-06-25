function calcPrice(wt,isPartner,qty=1){
    let weight=Number(wt);
        isPartner=Boolean(isPartner);
        qty=Number(qty);
    if(isPartner==true){
        if(weight>0 && weight<= 0.5){
            return {"price":50*qty,"gst":gst(50)*qty,"total":(50+gst(50))*qty};
        }
        else if(weight>0.5 && weight<= 5){
            return {"price":55*qty,"gst":gst(55)*qty,"total":(55+gst(55))*qty};
        }
        else if(weight>5 && weight<= 10){
            return {"price":60*qty,"gst":gst(60)*qty,"total":(60+gst(60))*qty};
        }
        else{
            return {"error":"You can send only 10 kg parcels Contact company"};
        }
    }
    else if(isPartner==false){
        if(weight>0 && weight<= 0.5){
            return {"price":80*qty,"gst":gst(80)*qty,"total":(80+gst(80))*qty};
        }
        else if(weight>0.5 && weight<= 5){
            return {"price":80*qty,"gst":gst(80)*qty,"total":(80+gst(80))*qty};
        }
        else if(weight>5 && weight<= 10){
            return {"price":100*qty,"gst":gst(100)*qty,"total":(100+gst(100))*qty};
        }
        else{
            return {"error":"You can send only 10 kg parcels Contact company"};
        }
    }
    else{
        return "Critical error in Data base. Cofused whether he is partner or not";
    }
}


function gst(amt){
  return (amt*18)/100;
}