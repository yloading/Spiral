<template>
    <canvas id="mySpiral" width="700" height="700" style="border:1px solid #c3c3c3;"></canvas>

</template>

<script>
export default {
    data() {
        return {
            randomData : [],
            randomId : [],
        }
    },

    methods: {

        groupBy(objectArray, property) {
            return objectArray.reduce((arr, obj) => {
                const value = obj[property]

                if (!arr[value]) {
                    arr[value] = []
                }

                arr[value].push(obj)

                return this.randomId = arr
            }, {})
        },

        setSpiral() {
            var canvas = document.getElementById("mySpiral");
            var cxt = canvas.getContext("2d");
            var x = 350;
            var y = 350;

            cxt.moveTo(x, y);
            
            var characters = this.getValues();
            var gap = 2.5;      
            var rotation = 0;
            var spread = 3;
            var spirals = 20;
            var stepsPerRotation = this.getValues().length;
            
            var increment = spread * 2 * Math.PI / stepsPerRotation;		
            var theta = increment;
            var maxFont = 12;
            
            cxt.font = '0px arial';
            cxt.textBaseline = 'center';

            let spiralCount = 2*spirals*Math.PI;
            let char = 0;


            while(theta < spiralCount) {
                var newX = x + theta * Math.cos(theta) * gap;
                var newY = y + theta * Math.sin(theta) * gap;
                var rot = Math.atan2(newY - y, newX - x);
                cxt.save();
                cxt.translate(newX, newY);
                cxt.rotate(rot + (rotation * 2 * Math.PI));
                cxt.font = (maxFont * (theta / spiralCount)) + 'px arial';
                cxt.fillText(characters[char], 0, 0);
                cxt.restore();
                theta = theta + increment;
                char++;
                if (char > characters.length - 1) char = 0;
            }
            cxt.stroke();
        },

        getValues() {
            const temp = []
            for (let index = 0; index < this.randomData.length; index++) {
                temp.push(this.randomData[index].values)   
            }
            return temp.join(' ')
        },

        async updateFlag() {
            this.groupBy(this.randomData, 'random_id')
            const keys = Object.keys(this.randomId)

            const res = await this.callApi('patch', '/api/randoms', keys)  
        }
    },
    
    async created() {
        
        const res = await this.callApi('get', '/api/breakdowns')

        if(res.status == 200) {
            this.randomData = res.data
            // display breakdowns which is flag = false in spiral manner
            this.setSpiral()
            // update flag to true (displayed)
            this.updateFlag()
        }
    }
}
</script>

