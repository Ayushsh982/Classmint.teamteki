const m=n=>{const i=n.split(`
`),e=[],r=[];let t=0;for(const o of i){const s=o.trim();if(s.includes("{")&&t++,s.includes("}")&&t--,!s){t===0?e.push(o):r.push(o);continue}t===0&&s.includes(":")&&!s.endsWith("{")?e.push(o):r.push(o)}return{root:e.join(`
`).trim(),rest:r.join(`
`).trim()}},u=(n,i)=>n?n.trim().toLowerCase().startsWith("body")?`{
${n}
}
`:`${i} {
${n}
}
`:"",l=n=>{const i=[];let e="",r=0;for(let t=0;t<n.length;t++){const o=n[t];if(o==="{"&&r++,o==="}"&&r--,e+=o,r===0&&e.trim().startsWith("@media")){const s=e.match(/@media\s*([^{]+)\{([\s\S]*)\}$/);s&&(i.push({type:"media",query:s[1].trim(),content:s[2].trim()}),e="")}r===0&&o==="}"&&!e.trim().startsWith("@media")&&(i.push({type:"normal",content:e.trim()}),e="")}return e.trim()&&i.push({type:"normal",content:e.trim()}),i},p=(n,i)=>n.replace(/(^|})\s*([^@{}][^{]*){/g,(e,r,t)=>{const o=t.split(",").map(s=>s.trim().toLowerCase().startsWith("body")?s.trim():`${i} ${s.trim()}`).join(", ");return`${r}
${o} {`}),c=(n,i)=>{const e=l(n);let r="";for(const t of e)if(t.type==="normal"&&(r+=p(t.content,i)+`
`),t.type==="media"){const o=c(t.content,i);r+=`@media ${t.query} {
${o}
}
`}return r.trim()},a=(n,i)=>{const{root:e,rest:r}=m(n);let t="";return e&&(t+=u(e,i)+`
`),r&&(t+=c(r,i)),t.trim()};export{a as s};
