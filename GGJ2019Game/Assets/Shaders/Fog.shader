Shader "Unlit/Fog"
{
    Properties
    {
        _MainTex ("Texture", 2D) = "white" {}
    }
    SubShader
    {
        Tags { "RenderType"="Opaque" }
        LOD 100
		ZTest Always Cull Off ZWrite Off

        Pass
        {
            CGPROGRAM
            #pragma vertex vert
            #pragma fragment frag

            #include "UnityCG.cginc"

            struct appdata
            {
				float4 vertex : POSITION;
				float2 uv : TEXCOORD0;
				float4 interpolatedRay : TEXCOORD1;
            };

            struct v2f
            {
                float2 uv : TEXCOORD0;
                float4 vertex : SV_POSITION;
				float4 interpolatedRay : TEXCOORD1;
            };

            sampler2D _MainTex;
			sampler2D_float _CameraDepthTexture;
			float _Sight;
			float3 _Camera2Player;

            v2f vert (appdata v)
            {
                v2f o;
                o.vertex = UnityObjectToClipPos(v.vertex);
				o.uv = v.uv;
				o.interpolatedRay = v.interpolatedRay;
                return o;
            }

            fixed4 frag (v2f i) : SV_Target
            {
                fixed4 col = tex2D(_MainTex, i.uv);

				float rawDepth = DecodeFloatRG(tex2D(_CameraDepthTexture, i.uv));
				float linearDepth = Linear01Depth(rawDepth);
				float4 distance2Cam = linearDepth * i.interpolatedRay;
				float4 distance2Player = distance2Cam - float4(_Camera2Player,0);
				float dis2Player = length(distance2Player);
				float ratio = saturate((dis2Player * dis2Player) / (_Sight*_Sight));

				col = lerp(col, float4(0, 0, 0, 1), ratio);

                return col;
            }
            ENDCG
        }
    }
}
