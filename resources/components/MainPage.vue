<template>
    <canvas id="myCanvas" width="500" height="500" style="border:1px solid #c3c3c3;"></canvas>

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

        setFlag(steps) {
            var c=document.getElementById("myCanvas");
            var cxt=c.getContext("2d");
            var centerX = 250;
            var centerY = 250;
            cxt.moveTo(centerX, centerY);
            
            var characters = this.getValues(); // character map for spiral
            var gap = 2.5; // increase this for spacing between spiral lines        
            var rotation = 0; // value between 0..1 that rotates the characters 0..360 degrees.
            var spread = 1; // increasing this makes the spread more
            var spirals = 15; // number of spirals
            var STEPS_PER_ROTATION = steps; // increasing this adds more characters
            
            var increment = spread*2*Math.PI/STEPS_PER_ROTATION;		
            var theta = increment;
            var maxFont = 12;
            cxt.font = '0px sans';
            cxt.textBaseline = 'center';
            let spiralCount = 2*spirals*Math.PI;
            let char = 0;
            while(theta < spiralCount) {
                var newX = centerX + theta * Math.cos(theta) * gap;
                var newY = centerY + theta * Math.sin(theta) * gap;
                var rot = Math.atan2(newY - centerY, newX - centerX);
                cxt.save();
                cxt.translate(newX, newY);
                cxt.rotate(rot + (rotation*2*Math.PI));
                cxt.font = (maxFont*(theta/spiralCount)) + 'px sans';
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
            // spiral
            this.setFlag(80)
            // update flag to true (displayed)
            this.updateFlag()
        }
    }
}
</script>

